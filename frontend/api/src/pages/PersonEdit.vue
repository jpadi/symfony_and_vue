<template>
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
        error : ''
      }
    },
    mounted() {
     this.fetchPerson();
    },
    methods: {
      async fetchPerson() {
        try {
          this.error = "";
          let id = this.$route.params.id
          this.model = (await axios.get( config.api.host + "api/v1/person/" +  id)).data
          this.user.fullName = this.model.name
        } catch (e) {

          if (e.response && e.response.data) {
            this.error = e.response.data.error
          } else {
            this.error = "An error has occurred"
          }
        }
      },
      async saveHandler(person) {

        try {
          let id = this.$route.params.id
          const options = {
            headers: {"content-type": "application/json"}
          }
          await  axios.put(config.api.host + "api/v1/person/" +  id, person, options)
          this.fetchPerson()
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
