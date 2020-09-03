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
                        <input id="name" type="text" class="validate" v-model="name">
                        <label for="name">Name</label>
                        <span class="text text-danger" v-if="error && errors.name">{{ errors.name[0] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="text" class="validate" v-model="email">
                        <label for="email">Email</label>
                        <span class="text text-danger" v-if="error && errors.email">{{ errors.email[0] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate" v-model="password">
                        <label for="password">Password</label>
                        <span class="text text-danger" v-if="error && errors.password">{{ errors.password[0] }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="confirm_password" type="password" class="validate" v-model="confirmPassword">
                        <label for="confirm_password">Confirm Password</label>
                        <span class="text text-danger" v-if="error && errors.confirmPassword">{{ errors.confirmPassword[0] }}</span>
                    </div>
                </div>
                <button class="btn btn-block waves-effect waves-light submit" type="button" name="action" @click.prevent="register()">Register</button>
            </div>
        </div>
    </div>
</template>
 
<script>
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
        this.axios.post('api/auth/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          confirmPassword: this.confirmPassword
     }).then(response => {
        this.isProgress = true;
        if(response.data.success == true)
        {
          setTimeout(() => {
            this.isProgress = false;
            this.$router.push({ name: 'login'})
            this.$toaster.success('Sign up successfully...')
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