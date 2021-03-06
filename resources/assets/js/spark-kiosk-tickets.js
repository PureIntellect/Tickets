Vue.component('spark-kiosk-tickets', {
    props: [],
    data() {
        var ticketsCreateForm = function() {
            return {
              id:'',
              user: '',
              user_email: '',
              title: '',
              category: '',
              priority: '',
              status: '',
              message: ''
            }
        };
        return {
          updatingTicket: null,
          deletingTicket: null,
          'results': [],
          'tickets': [],
          'users': [],
          'categories': [],
          'statuses': [],
          'priorities': [],
          newTicket: new SparkForm(ticketsCreateForm()),
          updateForm: new SparkForm(ticketsCreateForm()),
          deleteForm: new SparkForm({})
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
            axios.get('/pi/tickets/tickets')
                .then(response => {
                    this.tickets = response.data;
                });
        },

        /**
         * Get all of the users.
         */
        getUsers: function(){
            axios.get('/pi/tickets/get/users')
              .then(response => { this.users = response.data; });
        },
        getCategories: function(){
            axios.get('/pi/tickets/get/categories')
              .then(response => { this.categories = response.data; });
        },
        getStatuses: function(){
            axios.get('/pi/tickets/get/statuses')
              .then(response => { this.statuses = response.data; });
        },
        getPriorities: function(){
          axios.get('/pi/tickets/get/priorities')
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
        },
        editTicket(ticket) {
            this.updatingTicket = ticket;

            this.updateForm.title = ticket.title;
            this.updateForm.user = ticket.user.id;
            this.updateForm.category = ticket.category.id;
            this.updateForm.priority = ticket.priority.id;
            this.updateForm.status = ticket.status.id;
            this.updateForm.message = ticket.message;

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
                .then(response => {
                    this.results = response;
                    this.getTickets();
                    $('#modal-delete-ticket').modal('hide');
                });
        },
        showComment(ticket) {
          $('#ticket-comment').show();
          $('spark-kiosk-tickets').hide();
        }
    }
});
