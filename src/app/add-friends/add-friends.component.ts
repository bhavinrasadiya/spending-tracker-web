import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '../../../node_modules/@angular/router';
import { APIService } from '../services/api';
@Component({
  selector: 'app-add-friends',
  templateUrl: './add-friends.component.html',
  styleUrls: ['./add-friends.component.css']
})
export class AddFriendsComponent implements OnInit {
  addFriendForm = new FormGroup({
    frd_name: new FormControl('', Validators.required),
    email_id: new FormControl('', Validators.required),
    mob_no: new FormControl('', Validators.required)
  })
  constructor(private route: Router, private api: APIService) { }

  ngOnInit() {
    if(localStorage.getItem('group_id') == undefined)
    {
      this.route.navigateByUrl('/main');
    }
  }
  addFriend() {
    let body : any = this.addFriendForm.value;
    body.group_id = JSON.parse(localStorage.getItem('group_id')).group_id;
    this.api.addFriend(this.addFriendForm.value).subscribe((response)=>{
      if(response.message == 'Friend added Successfully'){
        localStorage.setItem('addFriend',JSON.stringify({'userLoggedin':true}));
        this.route.navigateByUrl('/dashboard');
      }
    })
  }

  readURL(e){
    console.log(e);
  }
  

}
