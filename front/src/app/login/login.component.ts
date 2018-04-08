import { Component, OnInit, ViewContainerRef } from '@angular/core';
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
	loginForm:boolean=false;
	loginUser:any={};
	constructor(public toastr: ToastsManager, vcr: ViewContainerRef,private router: Router,private userService:UserService) {
		this.toastr.setRootViewContainerRef(vcr);
	}

	ngOnInit() {	
		if (localStorage.getItem("currentUser") === null) {
			this.loginForm=true;
		} else {
			this.router.navigate(['/']);
		}			
	}
	
	login=function(user:User){	
		this.userService.login(user).subscribe(
			response => {
				if (response && response.status == '200') {
                    // store user details and jwt token in local storage to keep user logged in between page refreshes
                    localStorage.setItem('currentUser', JSON.stringify(response.user));					
					this.toastr.success('You have logged in successfully.Redirecting...', 'Success!');
					this.loginUser = '';
					setTimeout((router: Router) => {
						this.router.navigate(['/']);
					}, 3000);  //5s
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
