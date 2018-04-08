import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css']
})
export class NavComponent implements OnInit {
	
	@Input() public isLoggedIn: boolean;
	
	constructor() { }
	
	ngOnInit() {
		if(localStorage.getItem('currentUser')){
			this.isLoggedIn = true;
		}
		console.log(this.isLoggedIn);
	}
	appName='Blogging Demo';
	
	logout() {
        // remove user from local storage to log user out
        localStorage.removeItem('currentUser');
    }
}
