import { Component } from '@angular/core';
import { Router, RoutesRecognized, NavigationEnd } from '@angular/router';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
	
	public isloginPage = false;
	public isLoggedIn = false;;
	
	constructor(private router : Router) {
		this.router.events.subscribe(event => {
		  if (event instanceof RoutesRecognized) {
			 if (event.url == '/login'){
				this.isloginPage = true;
			 } else {
				this.isloginPage = false; 
			 }
		  }
		});	
	}
	
	public setLoginState(val){
		this.isLoggedIn = val;
	}
}
