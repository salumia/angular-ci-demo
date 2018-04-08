import { Component, OnInit, ViewContainerRef } from '@angular/core';
import { Router } from '@angular/router';
import { PostsService } from '../../services/posts.service';
import { Post } from '../../models/post';
import { ToastsManager } from 'ng2-toastr/ng2-toastr';

@Component({
  selector: 'app-addpost',
  templateUrl: './addpost.component.html',
  styleUrls: ['./addpost.component.css']
})
export class AddpostComponent implements OnInit {
	blogForm:boolean=false;
	user:any;
	newBlog:any={};
	constructor(public toastr: ToastsManager, vcr: ViewContainerRef,private router: Router,private p:PostsService) {
		this.toastr.setRootViewContainerRef(vcr);
	}

	ngOnInit() {	
		if (localStorage.getItem("currentUser") === null) {
			this.router.navigate(['/']);
		}
		this.blogForm=true;		
		this.user = localStorage.getItem('currentUser');
		this.newBlog.userId = JSON.parse(this.user).id;
	}
	
	saveBlog=function(post:Post){			
		this.p.create(post).subscribe(
			response => {
				if (response && response.status == '200') {
					this.toastr.success('Blog added successfully.Redirecting...', 'Success!');
					setTimeout((router: Router) => {
						this.router.navigate(['/myPost']);
					}, 2000);  //5s
				} else {
					this.toastr.error(response.message, 'Oops!');
					//error message
				}
			},
			error => {
				console.log(error);
				this.toastr.error(error, 'Oops!');
			});				
	}
}