import { Component, OnInit } from '@angular/core';
import { PostsService } from '../services/posts.service';
import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css']
})
export class PostsComponent implements OnInit {
	posts:any;	
	constructor(private route: ActivatedRoute,private p:PostsService) {
		this.getPostData();
	}

	ngOnInit() {

	}
  
	//Post
	getPostData(){
		this.route.params.forEach((params: Params) => {
			let id = +params['id'];
			this.getPostDetail(id);
		});
	}
	
	getPostDetail(postId){
		this.p.getPost(postId).subscribe(
			r => this.posts = r.post,
			error => console.error('Error: ' + error)
		);
	}
}
