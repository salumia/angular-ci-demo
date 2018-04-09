import { Component, OnInit, ViewContainerRef, EventEmitter, Output } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from '../services/user.service';
import { User } from '../models/user';
import { ToastsManager } from 'ng2-toastr/ng2-toastr';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
	loginUser:any={}; //object to contain user login form field values
	@Output() isLoggedIn = new EventEmitter<boolean>();
	
	constructor(public toastr: ToastsManager, vcr: ViewContainerRef,private router: Router,private userService:UserService) {
		this.toastr.setRootViewContainerRef(vcr);
	}

	ngOnInit() {	
		if (localStorage.getItem("currentUser") != null) {
			this.router.navigate(['/']);
		}			
	}
	
	login=function(user:User){	
		this.userService.login(user).subscribe(
			response => {
				if (response && response.status) {
                    // store user details and jwt token in local storage to keep user logged in between page refreshes
                    localStorage.setItem('currentUser', JSON.stringify(response.user));					
					this.toastr.success('You have logged in successfully.Redirecting...', 'Success!');
					this.loginUser = '';
					this.isLoggedIn.emit(true);
					//this.router.navigate(['/']);
					window.location.reload();
				} else {
					this.toastr.error(response.message, 'Oops!');
					//error message
				}
				
			},
			error => {
				console.log(error);
				this.toastr.error(error, 'Oops!');
			});		
		
	}
}
