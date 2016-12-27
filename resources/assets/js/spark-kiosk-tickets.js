Vue.component('spark-kiosk-tickets', {
    props: [],
    data() {
        return {
          'results': [],
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
            this.$http.get('/pi/tickets/tickets')
                .then(response => {
                    this.tickets = response.data;
                });
        },

        /**
         * Get all of the users.
         */
        getUsers: function(){
            this.$http.get('/pi/tickets/get/users')
              .then(response => { this.users = response.data; });
        },
        getCategories: function(){
            this.$http.get('/pi/tickets/get/categories')
              .then(response => { this.categories = response.data; });
        },
        getStatuses: function(){
            this.$http.get('/pi/tickets/get/statuses')
              .then(response => { this.statuses = response.data; });
        },
        getPriorities: function(){
          this.$http.get('/pi/tickets/get/priorities')
            .then(response => { this.priorities = response.data;});
        },
        /**
         * Create Ticket.
         */
        createTicket(){
          Spark.post('/pi/tickets/tickets', this.newTicket)
            .then(response => {
              this.results = response;
              this.getTickets();
            });
        }
        editTicket(ticket) {
            this.updatingTicket = ticket;

            this.updateForm.icon = ticket.icon;
            this.updateForm.body = ticket.body;
            this.updateForm.action_text = ticket.action_text;
            this.updateForm.action_url = ticket.action_url;

            $('#modal-update-ticket').modal('show');
        },


        /**
         * Update the specified announcement.
         */
        update() {
            Spark.put('/pi/tickets/tickets/' + this.updatingTicket.id, this.updateForm)
                .then(() => {
                    this.getTickets();

                    $('#modal-update-ticket').modal('hide');
                });
        },


        /**
         * Show the approval dialog for deleting an announcement.
         */
        approveTicketDelete(ticket) {
            this.deletingTicket = ticket;

            $('#modal-delete-ticket').modal('show');
        },


        /**
         * Delete the specified announcement.
         */
        deleteTicket() {
            Spark.delete('/pi/tickets/tickets/' + this.deletingTicket.id, this.deleteForm)
                .then(() => {
                    this.getTickets();
                    $('#modal-delete-ticket').modal('hide');
                });
        }
    }
});
