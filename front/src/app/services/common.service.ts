import { Injectable } from '@angular/core';

@Injectable()
export class CommonService {

	private BASE_URL = "http://localhost/blog/backend/index.php/";
	
	constructor() { }
	
	getBaseUrl(){
		return this.BASE_URL;
	}
}
