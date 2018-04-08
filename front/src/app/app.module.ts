import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';
import { HttpModule } from '@angular/http';
import { ToastModule } from 'ng2-toastr/ng2-toastr';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { AppRoutingModule } from './app.routing';
import { AppComponent } from './app.component';
import { NavComponent } from './nav/nav.component';

import{UserService} from './services/user.service';
import{PostsService} from './services/posts.service';
import{AuthenticationService} from './services/authentication.service';
import{CommonService} from './services/common.service';

import { PostsComponent } from './posts/posts.component';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';
import { MypostComponent } from './posts/mypost/mypost.component';
import { AddpostComponent } from './posts/addpost/addpost.component';

@NgModule({
  declarations: [
    AppComponent,
    NavComponent,
    PostsComponent,
    HomeComponent,
    LoginComponent,
    SignupComponent,
    MypostComponent,
    AddpostComponent
  ],
  imports: [
    BrowserModule, 
	BrowserAnimationsModule,
	ToastModule.forRoot(),
    FormsModule,
    HttpModule,
    AppRoutingModule
  ],
  providers: [UserService,PostsService,AuthenticationService,CommonService],
  bootstrap: [AppComponent]
})
export class AppModule { }
