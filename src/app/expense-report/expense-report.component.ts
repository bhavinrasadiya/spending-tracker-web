import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { APIService } from '../services/api';
import { Router } from '../../../node_modules/@angular/router';
import * as moment from 'moment';


@Component({
  selector: 'app-expense-report',
  templateUrl: './expense-report.component.html',
  styleUrls: ['./expense-report.component.css']
})
export class ExpenseReportComponent implements OnInit {
  expenses: any = [];
  minDate = new Date();
  maxDate = new Date();
  startDate: string = '';
  endDate: string = '';
  constructor(private route: Router, private api: APIService) {
   }

  ngOnInit() {
    if (localStorage.getItem('group_id') != undefined) {
      this.expensesList();
    }
    else {
      this.route.navigateByUrl('/main');
    }
    
  }
  onMinDateValueChange(value: Date): void {
    this.minDate = value;
    this.startDate = moment(this.minDate).format('YYYY-MM-DD');
    this.expensesList();
  }
  onMaxDateValueChange(value: Date): void {
    this.maxDate = value;
    this.endDate = moment(this.maxDate).format('YYYY-MM-DD');
    this.expensesList();
  }
  expensesList() {
    console.log(this.minDate);
    console.log(this.maxDate);
    let body = {
      'group_id': JSON.parse(localStorage.getItem('group_id')).group_id,
      'minDate': this.startDate,
      'maxDate': this.endDate,
    }
    this.api. expenseReports(body).subscribe((response) => {
      console.log(response);
      this.expenses = response.data;
    })
  }
}



  

 