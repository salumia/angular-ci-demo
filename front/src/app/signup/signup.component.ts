import { Component, OnInit, ViewContainerRef } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from '../services/user.service';
import { User } from '../models/user';
import { ToastsManager } from 'ng2-toastr/ng2-toastr';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent implements OnInit {
	
	newUser:any={};	//object to contain user form field values
	
	constructor(public toastr: ToastsManager, vcr: ViewContainerRef,private router: Router,private userService:UserService) {
		this.toastr.setRootViewContainerRef(vcr);
	}

	ngOnInit() {	
		//check if user logged in, redirect to home page
		if (localStorage.getItem("currentUser") != null) {
			this.router.navigate(['/']);
		}
	}
	
	saveUser=function(user:User){		
		this.userService.create(user).subscribe(
			response => {
				if (response && response.status) {
                    // store user details and jwt token in local storage to keep user logged in between page refreshes
                    localStorage.setItem('currentUser', JSON.stringify(response.user));
					this.toastr.success('You have registered successfully.Redirecting...', 'Success!');
					this.newUser = '';
					setTimeout((router: Router) => {
						this.router.navigate(['/login']);
					}, 3000);  //5s
				} else {
					this.toastr.error(response.message, 'Oops!');
					//error message
				}
			},
			error => {
				this.toastr.error(error, 'Oops!');
			});		
	}
}