<spark-kiosk-tickets inline-template>
  <div>
    <!-- Create Ticket -->
    <div class="panel panel-default">
      <div class="panel-heading">Create Ticket</div>
      <div class="panel-body">
          <div class="alert alert-info">
              Create a ticket for a customer
          </div>
          <form class="form-horizontal" role="form">
            <div class="row">
              <div class="col-md-4">

                <!-- User -->
                <div class="form-group" :class="{'has-error': form.errors.has('user_email')}">
                    <label class="col-md-4 control-label">User</label>
                    <div class="col-md-6">
                        <select class="form-control" name="user_id" v-model="newTicket.user_id">
                            <option value="">Choose User...</option>
                            <option v-for="usr in users" :value="usr.email">@{{ usr.name }}</option>
                        </select>
                    </div>
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Category</label>
                    <div class="col-md-6">
                        <select class="form-control" name="category_id" v-model="newTicket.category">
                            <option value="">Choose Category...</option>
                            <option v-for="cat in categories" :value="cat.id">@{{ cat.name }}</option>
                        </select>
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Status</label>
                    <div class="col-md-6">
                        <select class="form-control" name="category_id" v-model="newTicket.status">
                            <option value="">Choose Status...</option>
                            <option v-for="stat in statuses" :value="stat.id">@{{ stat.name }}</option>
                        </select>
                    </div>
                </div>

                <!-- Priority -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Priority</label>
                    <span class="help-block" v-show="newTicket.errors.has('name')">
                      @{{ newTicket.errors.get('user_email') }}
                    </span>
                    <div class="col-md-6">
                        <select class="form-control" name="category_id" v-model="newTicket.priority">
                            <option value="">Choose Priority...</option>
                            <option v-for="pri in priorities" value="pri.id">@{{ pri.name }}</option>
                        </select>
                    </div>
                </div>
              </div>

              <div class="col-md-8">

                <!-- Ticket -->
                <div class="form-group">
                    <label class="col-md-2 control-label">Ticket</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="ticket"  v-model="newTicket.body" rows="6" style="font-family: monospace;">
                        </textarea>
                    </div>
                </div>

                <!-- Create Button -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6" class="pull-right">
                        <button type="submit" class="btn btn-primary" @click="createTicket" :disable="newTicket.busy">
                            Create
                        </button>
                    </div>
                </div>
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
  </div>
</spark-kiosk-notify>
