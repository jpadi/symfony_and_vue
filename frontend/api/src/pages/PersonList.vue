<template>
    <div class="row">
      <div class="col-12">
        <base-button slot="footer" type="primary" fill @click="addHandler()">Add</base-button>
        <card :title="table1.title">
          <div class="table-responsive">
            <base-table :data="table1.data"
                        :columns="table1.columns"
                        thead-classes="text-primary">
              <template slot-scope="{row}">
                <td>{{row.id}}</td>
                <td>{{row.name}}</td>
                <td>{{row.email}}</td>
                <td class="td-actions text-right">
                  <base-button type="success" size="sm" icon @click="editHandler(row.id)">
                    <i class="tim-icons icon-settings"></i>
                  </base-button>
                  <base-button type="danger" size="sm" icon @click="deleteHandler(row.id)">
                    <i class="tim-icons icon-simple-remove"></i>
                  </base-button>
                </td>
              </template>
            </base-table>
          </div>
        </card>
      </div>
    </div>
</template>
<script>
import { BaseTable } from "@/components";
import config from '@/config';
import axios from 'axios';
const tableColumns = ["Id", "Name", "Email"];

export default {
  components: {
    BaseTable
  },
  data() {
    return {
      table1: {
        title: "Person List",
        columns: [...tableColumns],
        data: []
      }
    };
  },
  mounted() {
     this.fetchPersonList();
  },
  methods: {
    async fetchPersonList() {
      try {
        const response = (await axios.get( config.api.host + "api/v1/person")).data
        this.table1.data = response.items
      } catch (e) {
        console.log(e)
        // TODO: use template notifications
        alert("error loading person list")
      }
    },
    async deleteHandler(id) {
      try{
        await axios.delete(config.api.host +  "api/v1/person/" + id)
        await this.fetchPersonList()
      } catch (e) {
        console.log(e)
        alert("error deleting")
      }
    },
    addHandler() {
      this.$router.push("person/add" )
    },
    editHandler(id) {
      this.$router.push("person/edit/" + id)
    }
  }
};
</script>
<style>
</style>
