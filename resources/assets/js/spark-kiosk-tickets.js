Vue.component('spark-kiosk-tickets', {
    props: [
    ],
    data() {
        return {
          'tickets': [],
          'users': [],
          'categories': [],
          'statuses': [],
          'priorities': [],
          newTicket: new SparkForm({
            user_email: '',
            title:'',
            category: '',
            status: '',
            priority: '',
            message:'',
          })
        };
    },
    mounted(){
        this.getTickets();
        this.getUsers();
        this.getCategories();
        this.getStatuses();
        this.getPriorities();
    },
    methods: {
        /**
         * Get all of the Tickets.
         */
        getTickets: function(){
            this.$http.get('/pi/tickets')
                .then(response => {
                    this.tickets = response.data;
                });
        },

        /**
         * Get all of the users.
         */
        getUsers: function(){
            this.$http.get('/pi/users')
                .then(response => {
                    this.users = response.data;
                });
        },
        getCategories: function(){
            this.$http.get('/pi/categories')
                .then(response => {
                    this.categories = response.data;
                });
        },
        getStatuses: function(){
            this.$http.get('/pi/statuses')
                .then(response => {
                    this.statuses = response.data;
                });
        },
        getPriorities: function(){
            this.$http.get('/pi/priorities')
                .then(response => {
                    this.priorities = response.data;
                });
        },
        /**
         * Create Ticket.
         */
        createTicket(){
          Spark.post('/pi/tickets/create', this.newTicket)
            .then(response => {
              console.log(response);
              //this.getTickets();
            });
        }
    }
});
