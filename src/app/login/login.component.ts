import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '../../../node_modules/@angular/router';
import { APIService } from '../services/api';
import { BsModalService } from 'ngx-bootstrap/modal';
import { BsModalRef } from 'ngx-bootstrap/modal/bs-modal-ref.service';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  modalRef: BsModalRef; 
  loginForm = new FormGroup({
    group_id: new FormControl('', Validators.required),
    password: new FormControl('', Validators.required)
  })
  @ViewChild('template') elementView: ElementRef;
  constructor(private route: Router, private api: APIService,private modalService: BsModalService) { }

  ngOnInit() {
  }
openModal() {
    this.modalRef = this.modalService.show(this.elementView);
  }
  
  login() {
    this.api.login(this.loginForm.value).subscribe((response)=>{
      console.log(response);
      
      if(response.message == 'login Successfully'){
        localStorage.setItem('group_id',JSON.stringify({'group_id':this.loginForm.controls.group_id.value}));
        localStorage.setItem('group_name',response.group_detail.group_detail[0].group_name);
        this.route.navigateByUrl('/dashboard');
      }
      else {
        this.openModal();
      }
     
    })
  }
}
