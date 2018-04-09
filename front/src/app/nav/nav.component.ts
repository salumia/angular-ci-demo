import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css']
})
export class NavComponent implements OnInit {
	
	@Input() public loginState: boolean;
	public isLoggedIn: boolean = false;
	
	constructor(private router: Router,) { }
	
	ngOnInit() {
		console.log(this.loginState);
		if(localStorage.getItem('currentUser')){
			this.isLoggedIn = true;
		}
		console.log(this.isLoggedIn);
	}
	appName='Blogging Demo';
	
	logout() {
        // remove user from local storage to log user out
        localStorage.removeItem('currentUser');
		this.isLoggedIn = false;
		this.router.navigate(['/']);
    }
}
