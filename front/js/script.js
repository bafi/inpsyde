// Define a new component called user-table
Vue.component('user-table', {
    props: ['url'],
    data() {
        return {
            user: {},
            users: [],
            cachedUsers: {},
            loading: false,
            failedToFetchData: false,
        }
    },
    computed: {
        userListingURL: function () {
            return this.url + "/users";
        },
        userDetailsURL() {
            return id => this.userListingURL + `/${id}`;
        }
    },
    created() {
        this.loading = true;
        let self = this;
        let xhttp = new XMLHttpRequest();
        xhttp.open("GET", this.userListingURL, true);
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                self.users = JSON.parse(this.response)
                self.loading = false;
            } else if (this.status != 200) {
                self.failedToFetchData = true;
            }
        };
        xhttp.send();
    },
    methods: {
        displayUserDetails(id) {
            // Check user is requested before
            if (this.cachedUsers.hasOwnProperty(id)) {
                this.user = this.cachedUsers[id];

                return;
            }
            // Do a normal request for retrieve user details
            this.loading = true;
            let self = this;
            let xhttp = new XMLHttpRequest();
            xhttp.open("GET", this.userDetailsURL(id), true);
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    self.loading = false;
                    self.user = JSON.parse(this.response)
                    self.cachedUsers[id] = self.user;
                } else if (this.status != 200) {
                    self.loading = false;
                    self.failedToFetchData = true;
                }
            };
            xhttp.send();
        },
        isEmpty(obj) {
            for (var prop in obj) {
                if (obj.hasOwnProperty(prop)) {
                    return false;
                }
            }

            return JSON.stringify(obj) === JSON.stringify({});
        }
    },
    template: '<div>' +
        '<div>' +
        '<h4 v-if="isEmpty(user)">Users</h4>' +
        '<table v-if="isEmpty(user)">\n' +
        '    <thead>\n' +
        '      <th>Id</th>\n' +
        '      <th>Name</th>\n' +
        '      <th>Username</th>\n' +
        '    </thead>\n' +
        '    <tbody v-bind:style= "[loading ? {opacity: 0.2} : {}]">\n' +
        '      <tr v-if="failedToFetchData"><td colspan="3">Error while fetching data, please try again later.</td></tr>' +
        '      <tr v-for="user in users">\n' +
        '        <td><a href="javascript:void(0)" @click="displayUserDetails(user.id)" v-text="user.id"></a></td>\n' +
        '        <td><a href="javascript:void(0)" @click="displayUserDetails(user.id)" v-text="user.name"></a></td>\n' +
        '        <td><a href="javascript:void(0)" @click="displayUserDetails(user.id)" v-text="user.username"></a></td>\n' +
        '      </tr>\n' +
        '    </tbody>\n' +
        '  </table>' +
        '</div>' +
        '<div v-if="!isEmpty(user)">' +
        '    <h4><span v-text="user.name"></span></h4>\n' +
        '    <ul>\n' +
        '      <li><strong>ID: </strong><span v-text="user.id"></span></li>\n' +
        '      <li><strong>Name: </strong><span v-text="user.name"></span></li>\n' +
        '      <li><strong>Username: </strong><span v-text="user.username"></span></li>\n' +
        '      <li><strong>Email: </strong><span v-text="user.email"></span></li>\n' +
        '      <li><strong>Address: </strong><span v-text="user.address.street"></span>, <span v-text="user.address.suite"></span>, <span v-text="user.address.city"></span></li>\n' +
        '      <li><strong>Phone: </strong><span v-text="user.phone"></span></li>\n' +
        '      <li><strong>Website: </strong><span v-text="user.website"></span></li>\n' +
        '      <li><strong>Company: </strong><span>{{ user.company.name }}, {{ user.company.catchPhrase }}, {{ user.company.bs }}</span></li>\n' +
        '    </ul>' +
        '<a href="javascript:void(0)" @click="user = {}">Back</a>' +
        '</div>' +
        '</div>'
})

var app = new Vue({
    el: '#user-container',
})