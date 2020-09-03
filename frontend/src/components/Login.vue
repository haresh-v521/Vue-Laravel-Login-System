<template>
    <div class="row" style="margin:2% auto; width:420px;margin-bottom:30px;">
        <div class="container col s12">
            <div class="heading">
                <center><h5>Login</h5></center>
            </div>
            <div class="progress" v-if="isProgress">
                <div class="indeterminate"></div>
            </div>
            <div class="alert alert-danger" v-if="loginError && errors.message">
                <span>{{ errors.message[0] }}</span>
            </div>
            <div class="login-form">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" placeholder="Email" type="text" class="validate" v-model="email">
                        <span class="text text-danger" v-if="loginError && errors.email">{{ errors.email[0] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" placeholder="Password" type="password" class="validate" v-model="password">
                        <span class="text text-danger" v-if="loginError && errors.password">{{ errors.password[0] }}</span>
                    </div>
                </div>
                <button class="btn btn-block waves-effect waves-light submit" type="button" name="action" @click="login()">Login</button>
            </div>
        </div>
    </div>
</template>
<script>
import store from '../store'
import {environment_api } from '../env';

    export default {
       data() {
         return {
           email: '',
           password: '',
           loginError: false,
           errors: {},
           isProgress: false, 
         }
    },
    methods: {
      login() {
        this.loginError = false;
        this.axios.post(environment_api.api_url+'login', {
        email: this.email,
        password: this.password
      }).then(response => {
        this.isProgress = true;
        if(response.data.success == true)
        {
           setTimeout(() => {
             this.isProgress = false;
             store.commit('LoginUser', response.data);
             this.$router.push({name: 'dashboard'})
           },2000);
        }
        else {
           this.isProgress = true;
           setTimeout(() => {
             this.isProgress = false;
             this.loginError = true;
             this.errors = response.data.errors
           },1000);
        }
      }).catch(error => {
         this.isProgress = false;
         this.loginError = true;
         this.errors = error.response.data.errors
      });
    },
  }
 }
</script>