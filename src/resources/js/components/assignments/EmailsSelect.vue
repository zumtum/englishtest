<template>
    <div class="card">
        <h5 class="card-header">Emails selection</h5>
        <div class="card-body row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" v-model="serchedEmail" placeholder="Search by emails"
                           aria-label="Search">
                </div>
                <div class="form-group selection-container">
                    <table class="table table-borderless table-hover">
                        <thead class="thead-dark">
                            <tr class="d-flex">
                                <th scope="col" class="col-6">Email</th>
                                <th scope="col" class="col-6">Roles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in filteredUsers"
                                :key="user.id" class="d-flex"
                                :class="{ 'table-info': user.active }"
                                @click="addSelectedUser(user)">
                                <td class="col-6">
                                    <span>{{ user.email }}</span>
                                </td>
                                <td class="col-6">
                                    <span>{{ getRoles(user) }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group assigned-container">
                    <h5 class="card-title mt-2">Assigned emails</h5>
                    <table class="table table-borderless table-hover mt-4">
                        <thead class="thead-dark">
                        <tr class="d-flex">
                            <th scope="col" class="col-8">Email</th>
                            <th scope="col" class="col-4 text-right">Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(selectedUser, index) in selectedUsers" :key="selectedUser.id"
                            class="d-flex">
                            <td class="col-8">
                                <input type="hidden" name="emails[]" :value="selectedUser.email">
                                <input type="hidden" name="users[]" :value="selectedUser.id">
                                <span>{{ selectedUser.email }}</span>
                            </td>
                            <td class="col-4 text-right">
                                <button class="btn btn-danger btn-sm" @click="removeSelectedUsers(index)">x</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    props: {
      users: {
        type: Array,
        required: true,
      },
      relatedUsers: {
        type: Array,
        default: function () {
          return [];
        },
      },
    },
    data() {
      return {
        selectedUsers: [],
        serchedEmail: '',
      }
    },
    methods: {
      removeSelectedUsers(index) {
        const userId = this.selectedUsers[index].id;

        this.selectedUsers.splice(index, 1);

        this.users.forEach(user => {
          if (userId === user.id) {
            user.active = false;
          }
        });
      },
      addSelectedUser(user) {
        if (!this.hasUser(user)) {
          user.active = !user.active;
          this.selectedUsers.push(user);
        }
      },
      hasUser(user) {
        let userIsset = false;

        this.selectedUsers.forEach(selectedUser => {
          if (selectedUser.id === user.id) {
            userIsset = true;
            return false;
          }
        });

        return userIsset;
      },
      getRoles(user) {
        return user.roles.map(role => role.name).join(', ');
      },
      initRelatedUsers() {
        this.selectedUsers = this.relatedUsers;
        this.selectedUsers.forEach(selectedUser => {
          let foundUser = this.users.find(user => {
            return user.id === selectedUser.id;
          });

          foundUser.active = true;
        });
      }
    },
    computed: {
      filteredUsers() {
        return this.users.filter(user => {
          return user.email.match(this.serchedEmail);
        });
      },
    },
    created() {
      this.initRelatedUsers();
    },
  };
</script>

<style scoped>
    .selection-container tr {
        cursor: pointer;
    }

    .selection-container table.table tbody {
        max-height: 350px;
        overflow-y: auto;
        display: block;
    }
</style>
