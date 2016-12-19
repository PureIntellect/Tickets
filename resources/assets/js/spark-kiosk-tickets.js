Vue.component('spark-kiosk-tickets', {
    props: [
    ],
    data() {
        return {
            'tickets': [],
            'users': [],
            'newTicket': {
                "user_id": null,
                "category": null,
            }
        };
    },
    ready(){
        this.getTickets();
        this.getUsers();
        this.getCategories();
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
        /**
         * Create Ticket.
         */
        createTicket: function(){
            this.$http.post('/pi/tickets/create', this.newTicket)
                .then(response => {
                    this.newTicket = {};
                    this.getTickets();
                });
        }

    }
});
