import { NgModule } from '@angular/core';
import { RouterModule, PreloadAllModules } from '@angular/router';
import { HomeComponent} from './home/home.component';
import { PostsComponent} from './posts/posts.component';
import { SignupComponent} from './signup/signup.component';
import { LoginComponent} from './login/login.component';
import { MypostComponent } from './posts/mypost/mypost.component';
import { AddpostComponent } from './posts/addpost/addpost.component';

@NgModule({
    imports: [
    RouterModule.forRoot([
		 { path: '', component: HomeComponent },
		 { path: 'post/:id', component: PostsComponent},
         { path: 'signup', component: SignupComponent },	     
	     { path: 'login', component: LoginComponent},
	     { path: 'myPost', component: MypostComponent},
	     { path: 'addPost', component: AddpostComponent}

    ],{preloadingStrategy:PreloadAllModules})
  ],
  exports:[RouterModule]
 })
export class AppRoutingModule {}
