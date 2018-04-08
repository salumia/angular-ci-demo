import { Injectable } from '@angular/core';
import { Http,Headers,Response  } from '@angular/http';
import  {User} from '../models/user';
import  {CommonService} from './common.service';

import 'rxjs/add/operator/map';
import {Observable,Subject} from 'rxjs/Rx';

@Injectable()

export class UserService {
	
	private BASE_URL;
	private headers: Headers = new Headers();

	constructor(private http: Http, private common:CommonService) { 
		this.BASE_URL = this.common.getBaseUrl();
		this.headers = new Headers({
			'Content-Type': 'application/json'
		});
	}
	
	create(user: User): Observable<any> {
		return this.http.post(this.BASE_URL + 'User/register', user,{ headers:this.headers})
				   .map(
			response => response.json()
		);
	}
	
	login(user: User): Observable<any> {
		return this.http.post(this.BASE_URL + 'User/login', user,{ headers:this.headers})
				   .map(
			response => response.json()
		);
	} 

}
