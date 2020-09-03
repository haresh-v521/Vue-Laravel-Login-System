<template>
    <div class="row" style="margin:2% auto; width:420px; margin-bottom:90px;">
        <div class="container col s12">
            <div class="heading">
                <center><h5>Register</h5></center>
            </div>  
            <div class="progress" v-if="isProgress">
                <div class="indeterminate"></div>
            </div>
            <div class="login-form">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="name" type="text" placeholder="Name" class="validate" v-model="name"> 
                        <span class="text text-danger" v-if="error && errors.name">{{ errors.name[0] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="text"  placeholder="Email" class="validate" v-model="email">
                        <span class="text text-danger" v-if="error && errors.email">{{ errors.email[0] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password"  placeholder="Password" class="validate" v-model="password">
                        <span class="text text-danger" v-if="error && errors.password">{{ errors.password[0] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="confirm_password" type="password"  placeholder="Confirm Password" class="validate" v-model="confirmPassword">
                        <span class="text text-danger" v-if="error && errors.confirmPassword">{{ errors.confirmPassword[0] }}</span>
                    </div>
                </div>
                <button class="btn btn-block waves-effect waves-light submit" type="button" name="action" @click.prevent="register()">Register</button>
            </div>
        </div>
    </div>
</template>
 
<script>
import {environment_api } from '../env';

export default {
   data(){
     return {
        name: '',
        email: '',
        password: '',
        confirmPassword:'',
        error: false,
        errors: {},
        success: false,
        isProgress: false
     };
   },
   methods: {
     register(){
        this.axios.post(environment_api.api_url+'register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.confirmPassword
     }).then(response => {
        this.isProgress = true;
        if(response.data.success == true)
        {
          setTimeout(() => {
            this.isProgress = false;
            this.$router.push({ name: 'login'})
            this.$toaster.success('Register successfully...')
        }, 2000)
      }
    }).catch(error => {
        this.isProgress = false;
        this.error = true;
        this.errors = error.response.data.errors
    });
  }
 }
}
</script>