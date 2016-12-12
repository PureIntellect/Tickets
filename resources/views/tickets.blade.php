<spark-kiosk-tickets inline-template>
  <!-- Create Ticket -->
  <div class="panel panel-default">
      <div class="panel-heading">Create Ticket</div>

      <div class="panel-body">
          <div class="alert alert-info">
              Create a ticket for a customer
          </div>

          <form class="form-horizontal" role="form">

              <!-- User -->
              <div class="form-group">
                  <label class="col-md-4 control-label">User</label>

                  <div class="col-md-6">
                      <select class="form-control" name="user_id" v-model="newTicket.user_id">
                          <option value="">Choose User...</option>
                          <option value="@{{ usr.id }}" v-for="usr in users">@{{ usr.name }}</option>
                      </select>
                  </div>
              </div>

              <!-- Notification -->
              <div class="form-group">
                  <label class="col-md-4 control-label">Ticket</label>
                  <div class="col-md-6">
                      <textarea class="form-control" name="ticket"  v-model="newTicket.body" rows="7" style="font-family: monospace;">
                      </textarea>
                  </div>
              </div>
              <!-- Create Button -->
              <div class="form-group">
                  <div class="col-md-offset-4 col-md-6">
                      <button type="submit" class="btn btn-primary" @click.prevent="createTicket">
                          Create
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>
    <!-- Open Tickets List -->
        <div class="panel panel-default" v-cloak>
            <div class="panel-heading">Recent Tickets</div>
            <div class="panel-body">
                <table class="table table-borderless m-b-none">
                    <thead>
                        <th>Created By</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Category</th>
                        <th></th>
                    </thead>

                    <tbody>
                        <tr v-for="ticket in tickets">
                            <!-- Photo -->
                            <td>
                                <img v-if="ticket.creator" :src="ticket.creator.photo_url" class="spark-profile-photo">
                            </td>

                            <!-- Date -->
                            <td>
                                <div class="btn-table-align">
                                    @{{ ticket.created_at | datetime }}
                                </div>
                            </td>
                            <td>
                                <img :src="ticket.user.photo_url" class="spark-profile-photo">
                            </td>
                            <td>
                                @{{ticket.category}}
                            </td>

                            <!-- Edit Button -->
                            {{-- <td>
                                <button class="btn btn-primary" @click="editAnnouncement(announcement)">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td> --}}

                            <!-- Delete Button -->
                            <td>
                                {{-- <button class="btn btn-danger-outline" @click="approveAnnouncementDelete(announcement)">
                                    <i class="fa fa-times"></i>
                                </button> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</spark-kiosk-notify>
