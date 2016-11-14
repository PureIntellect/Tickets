Vue.component('spark-kiosk-tickets', {
    props: [
    ],
    data() {
        return {
            'tickets': [],
            'users': [],
            'createTicket': {
                "user_id": null
            }
        };
    },
    ready(){
        this.getTickets();
        this.getUsers();
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

        /**
         * Create Ticket.
         */
        createTicket: function(){
            this.$http.post('/pi/tickets/create', this.createTicket)
                .then(response => {
                    this.createTicket = {};
                    this.getTickets();
                });
        }

    }
});
