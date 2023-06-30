import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '../../../node_modules/@angular/router';
import { APIService } from '../services/api';
@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})

export class DashboardComponent implements OnInit {


  allFriends: any = [];
  expenses: any = [];
  group_name = localStorage.getItem('group_name');
  group_of_total: any = 0;
  membersBalance: any = [];
  selectedFriends: any = [];
  payer: any;
  amount = 0;
  description: any;
  finalCountLength: any;

  constructor(private route: Router, private api: APIService) { }

  ngOnInit() {
    if (localStorage.getItem('group_id') != undefined) {
      this.getFriends();
      this.getExpenses();
      this.grouptotal();
      this.expensesList();
    }
    else {
      this.route.navigateByUrl('/main');
    }
  }

  getFriends() {
    let body = {
      'group_id': JSON.parse(localStorage.getItem('group_id')).group_id
    }
    this.api.getFriends(body).subscribe((response) => {
      console.log(response);
      if (response.message == 'All friends list') {
        this.allFriends = response.data.friends;
        this.payer = this.allFriends[0].frd_id;
        this.allFriends.forEach(element => {
        this.selectedFriends.push(parseInt(element.frd_id));
        });
        console.log(this.selectedFriends);
        this.finalCountLength = this.selectedFriends.length;

      }
    })
  }

  addToExpense(event) {
    if (event.target.checked) {
      this.selectedFriends.push(parseInt(event.target.id));
    }
    else if (!event.target.checked) {

      this.selectedFriends = this.selectedFriends.filter(item => item != event.target.id);

    }
    this.finalCountLength = this.selectedFriends.length;
    console.log(this.selectedFriends);
  }
  grouptotal() {
    let body = {
      'group_id': JSON.parse(localStorage.getItem('group_id')).group_id
    }
    this.api.groupTotal(body).subscribe((response) => {
      console.log(response);
      this.group_of_total = response.total;

    })
  }


  getExpenses() {
    let body = {
      'group_id': JSON.parse(localStorage.getItem('group_id')).group_id
    }
    this.api.getexpenses(body).subscribe((response) => {
      this.membersBalance = response.data;
      console.log(this.membersBalance);

    })
  }
  expensesList() {
    let body = {
      'group_id': JSON.parse(localStorage.getItem('group_id')).group_id
    }
    this.api.expensesList(body).subscribe((response) => {
      console.log(response);
      this.expenses = response.data;

    })
  }

  onChange(e) {
    console.log(e.target.value);
  }
  logout() {
    localStorage.clear();
    this.route.navigateByUrl('/main');
  }
  close()
{
  this.amount=0;
  this.description='';
}
  addbill() {
    let body: any = {
      "description": this.description,
      "amount": this.amount,
      "payer": this.payer,
      "group_id": JSON.parse(localStorage.getItem('group_id')).group_id,
      "friends_to_devide": this.selectedFriends
    }
    this.api.addExpense(body).subscribe((response) => {
      console.log(response);
      
      if(response.message == 'Expense added Successfully')
      {
        this.getExpenses();
        this.expensesList();
        this.grouptotal()
        
        this.amount=0;
        this.description='';
        this.route.navigateByUrl('/dashboard');
      }
    })

  }
}
