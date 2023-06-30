import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from '../../../node_modules/rxjs';

@Injectable()
export class APIService {
    url = 'http://localhost/API/'
    httpOptions: any;
    constructor(private http: HttpClient) {
        this.httpOptions = {
            headers: new HttpHeaders({
                'Content-Type': 'application/json'
            })
        };
    }

    /** POST: add a new hero to the database */
    login(body: any): Observable<any> {
        return this.http.post(this.url + 'login.php', body, this.httpOptions);
    }
    signup(body: any): Observable<any> {
        return this.http.post(this.url + 'signup.php', body, this.httpOptions);
    }
    addFriend(body: any): Observable<any> {
        return this.http.post(this.url + 'addfriend.php', body, this.httpOptions);
    }
    groupTotal(body: any): Observable<any> {
        return this.http.post(this.url + 'group_total.php', body, this.httpOptions);
    }

    getFriends(body: any): Observable<any> {
        return this.http.post(this.url + 'getFriends.php', body, this.httpOptions);
    }
    getexpenses(body: any): Observable<any> {
        return this.http.post(this.url + 'allexpenses.php', body, this.httpOptions);
    }
    expensesList(body: any): Observable<any> {
        return this.http.post(this.url + 'expenseList.php', body, this.httpOptions);
    }
    addExpense(body: any): Observable<any> {
        return this.http.post(this.url + 'expense.php', body, this.httpOptions);
    }
    expenseReports(body: any): Observable<any> {
        return this.http.post(this.url + 'expenseReport.php', body, this.httpOptions);
    }
}