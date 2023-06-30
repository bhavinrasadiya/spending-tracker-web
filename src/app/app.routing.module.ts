import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { SignUpComponent } from './sign-up/sign-up.component';
import { MainComponent } from './main/main.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { AccountComponent } from './account/account.component';
import { AddFriendsComponent } from './add-friends/add-friends.component'
import { ExpenseReportComponent } from './expense-report/expense-report.component'


const routes: Routes = [
    { path: 'login', component: LoginComponent },
    { path: 'signup', component: SignUpComponent},
    { path: 'main', component: MainComponent},
    { path: 'dashboard', component: DashboardComponent},
    { path: 'account', component: AccountComponent},
    { path: 'addfriend', component: AddFriendsComponent},
    { path: 'expense-report', component: ExpenseReportComponent},

    { path: '', redirectTo:'/main', pathMatch: 'full'}
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }