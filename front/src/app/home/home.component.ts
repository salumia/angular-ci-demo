import { Component, OnInit } from '@angular/core';
import { PostsService } from '../services/posts.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
	posts:any;	
	constructor(private p:PostsService) {
		this.p.getAll().subscribe(
			result => {
				if(result.status){
					this.posts = result.posts
				}				
			},
			error => console.error('Error: ')
		);
	}
	
	ngOnInit() {

	}
}
