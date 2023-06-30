import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '../../../node_modules/@angular/router';
import { APIService } from '../services/api';
import { BsModalService } from 'ngx-bootstrap/modal';
import { BsModalRef } from 'ngx-bootstrap/modal/bs-modal-ref.service';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})

export class SignUpComponent implements OnInit {
  msg:string; 
  modalRef: BsModalRef; 
  signupForm = new FormGroup({
    group_name: new FormControl('', Validators.required),    
    group_id: new FormControl('', Validators.required),
    password: new FormControl('', Validators.required),
    confirmpassword: new FormControl('', Validators.required)

  })
  @ViewChild('template') elementView: ElementRef;
  constructor(private route: Router, private api: APIService,private modalService: BsModalService) { }

 
  ngOnInit() {
  }
  openModal() {
    this.modalRef = this.modalService.show(this.elementView);
  }
  signup() {
    this.api.signup(this.signupForm.value).subscribe((response)=>{
     this.msg=response.message;
      if(response.message == 'Signup Successfully'){
        this.openModal();
        this.route.navigateByUrl('/login');
      }
      else if(response.message == 'This Group id is already Exists'){
        this.openModal();
      }
      else if(response.message == 'Password and Confirm Password is Not Match'){
        this.openModal();
      }
      else{
        this.openModal();
      }
    })
  }
}
