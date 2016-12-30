<spark-kiosk-tickets inline-template>
  <div>
  <!-- Create Ticket -->
    @include('Tickets::tickets.create')
  <!-- Open Tickets List -->
  <div class="panel panel-default" v-cloak>
    <div class="panel-heading">Recent Tickets</div>
      <div class="panel-body">
        <table class="table table-borderless m-b-none">
          <thead>
            <th>User</th>
            <th>Title</th>
            <th>Priority</th>
            <th>Category</th>
            <th>Status</th>
            <th> </th>
          </thead>
          <tbody>
            <tr v-for="ticket in tickets">
              <!-- User Photo/Infor -->
              <td>
                <img v-if="ticket.user" :src="ticket.user.photo_url" class="spark-profile-photo">
                @{{ ticket.user.name }}
              </td>

              <!-- Title -->
              <td>@{{ ticket.title }}</td>
              <!-- Priority -->
              <td>@{{ ticket.priority.name }}</td>
              <!-- Category -->
              <td>@{{ticket.category.name }}</td>
              <!-- Status -->
              <td>@{{ticket.status.name }}</td>

              <td>
                <button class="btn btn-primary" data-toggle="tooltip" title="Edit" @click="editTicket(ticket)">
                  <i class="fa fa-pencil"></i>
                </button>
                <button class="btn btn-success" data-toggle="tooltip" title="Comment" @click="commentTicket(ticket)">
                  <i class="fa fa-commenting"></i>
                </button>
                <button class="btn btn-danger" data-toggle="tooltip" title="Delete" @click="approveTicketDelete(ticket)">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Update Ticket Modal -->
    @include('Tickets::tickets.update_modal')

    <!-- Delete Ticket Modal -->
    @include('Tickets::tickets.delete_modal')
  </div>
</spark-kiosk-tickets>
