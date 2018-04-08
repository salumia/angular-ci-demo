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
			'Content-Type': 'application/json'
		});
	}

	getAll() {
		return this.http.get(this.BASE_URL + 'Post' ).map(
			response => response.json()
		);
	}
	getAllByUser(id) {
		console.log(id)
		return this.http.get(this.BASE_URL + 'Post/myPosts/'+ id).map(
			response => response.json()
		);
	}
	getPost(id) {
		return this.http.get(this.BASE_URL + 'Post/view/' +  id).map(
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