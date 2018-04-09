import { Injectable } from '@angular/core';

@Injectable()
export class CommonService {

	private BASE_URL = "http://localhost/blog-demo/angular-ci-demo/backend/index.php/";
	private userToken = "";
	
	constructor() { }
	
	getBaseUrl(){
		return this.BASE_URL;
	}	
	
	getToken(){
		this.userToken = localStorage.getItem('currentUser');
		return this.userToken;
	}
}
