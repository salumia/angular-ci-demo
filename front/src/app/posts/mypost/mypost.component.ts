import { Component, OnInit, ViewContainerRef } from '@angular/core';
import { Router } from '@angular/router';
import { PostsService } from '../../services/posts.service';
import { ToastsManager } from 'ng2-toastr/ng2-toastr';

@Component({
  selector: 'app-mypost',
  templateUrl: './mypost.component.html',
  styleUrls: ['./mypost.component.css']
})
export class MypostComponent implements OnInit {
	posts:any;	
	constructor(public toastr: ToastsManager, vcr: ViewContainerRef,private router: Router,private p:PostsService) {
		this.toastr.setRootViewContainerRef(vcr);
		if (localStorage.getItem("currentUser") === null) {
			this.router.navigate(['/']);
		}
		this.p.getAllByUser().subscribe(
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