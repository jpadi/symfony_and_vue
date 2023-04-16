<template xmlns="http://www.w3.org/1999/html">
  <div class="row">
    <div class="col-md-8">

     <base-alert type="danger" dismissible v-if="error!==''">
         <strong>Error!</strong> {{ error }}
     </base-alert>

      <edit-profile-form :model="model" @save-click="saveHandler($event)">
      </edit-profile-form>
    </div>
    <div class="col-md-4">
      <user-card :user="user"></user-card>
    </div>
  </div>
</template>
<script>
  import EditProfileForm from './Profile/EditProfileForm';
  import UserCard from './Profile/UserCard'
  import axios from 'axios';
  import config from '@/config';
  import BaseAlert from "../components/BaseAlert";
  export default {
    components: {
      BaseAlert,
      EditProfileForm,
      UserCard
    },
    data() {
      return {
        model: {
          name: '',
          email: '',
        },
        user: {
          fullName: '',
          title: 'Ceo/Co-Founder',
          description: `Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...`,
        },
        error: ''
      }
    },
    methods: {
      async saveHandler(person) {
        try {
          this.error = ""
          const options = {
            headers: {"content-type": "application/json"}
          }
          const response = (await axios.post(config.api.host + "api/v1/person", person, options)).data
          this.$router.push("/person/edit/" + response.id)

        } catch (e) {

          if (e.response && e.response.data) {
            this.error = e.response.data.error
          } else {
            this.error = "An error has occurred"
          }
        }

      }
    }
  }
</script>
<style>
</style>
