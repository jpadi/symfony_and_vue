<!-- eslint-disable vue/no-mutating-props -->
<template>
  <card>
    <h5 slot="header" class="title">Edit Profile</h5>
    <div class="row">
      <div class="col-md-5 pr-md-1">
        <base-input
          label="Name"
          placeholder="Name"
          v-model="model.name"
        >
        </base-input>
      </div>
      <div class="col-md-3 px-md-1">
        <base-input
          label="Email"
          placeholder="Email"
          v-model="model.email"
        >
        </base-input>
      </div>
    </div>
    <base-button slot="footer" type="primary" fill @click="clickButton()">Save</base-button>
  </card>
</template>
<script>
export default {
  props: {
    model: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  methods: {
    clickButton() {
      this.$emit("save-click", this.model)
    }
  }
};
</script>
<style></style>
