import { Injectable } from '@angular/core';
import { Http,Headers,Response  } from '@angular/http';
import  {Post} from '../models/post';
import  {CommonService} from './common.service';

import 'rxjs/add/operator/map';
import {Observable,Subject} from 'rxjs/Rx';

@Injectable()
export class PostsService {

	private BASE_URL;
	private headers: Headers = new Headers();

	constructor(private http: Http, private common:CommonService) { 
		this.BASE_URL = this.common.getBaseUrl();
		this.headers = new Headers({
			'Content-Type': 'application/json',
			'Authorization': 'Bearer ' + this.common.getToken()
		});
	}

	public handleError = (error: Response) => {
			return error.statusText;
	}
	
	getAll(): Observable<any> {
		return this.http.get(this.BASE_URL + 'Post' ).map(
			response => response.json()
		)
	}
	
	getAllByUser(): Observable<any> {
		return this.http.post(this.BASE_URL + 'Post/myPosts/', '',{ headers:this.headers})
				   .map(
			response => response.json()
		);
	}
	
	getPost(id) {
		return this.http.post(this.BASE_URL + 'Post/view/' +  id, '',{ headers:this.headers}).map(
			response => response.json()
		);
	}

	create(post: Post): Observable<any> {
		return this.http.post(this.BASE_URL + 'Post/create/', post,{ headers:this.headers})
				   .map(
			response => response.json()
		);
	}
}