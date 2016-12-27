<spark-kiosk-tickets inline-template>
  <div>
    <!-- Create Ticket -->
    <div class="panel panel-default">
      <div class="panel-heading">Create Ticket</div>
      <div class="panel-body">
          <div class="alert alert-info alert-dismissible" v-if="results == null">
              Create a ticket for a customer
          </div>
          <div class="alert alert-success alert-dismissible" v-if="results.status=='Success'">
              @{{ results.message }}
          </div>
          <form role="form" class="form-horizontal">
            <div class="row">
              <div class="col-md-4">
                <!-- User -->
                <div class="form-group" :class="{'has-error': newTicket.errors.has('user_email')}">
                  <span class="help-block" v-show="newTicket.errors.has('user_email')">
                    @{{ newTicket.errors.get('user_email') }}
                  </span>
                    <label class="col-md-4 control-label">User</label>
                    <div class="col-md-6">
                        <select class="form-control" name="user_email" v-model="newTicket.user_email">
                            <option value="">Choose User...</option>
                            <option v-for="usr in users" :value="usr.email">@{{ usr.name }}</option>
                        </select>
                    </div>
                </div>

                <!-- Category -->
                <div class="form-group" :class="{'has-error': newTicket.errors.has('category')}">
                  <span class="help-block" v-show="newTicket.errors.has('category')">
                    @{{ newTicket.errors.get('category') }}
                  </span>
                  <label class="col-md-4 control-label">Category</label>
                  <div class="col-md-6">
                    <select class="form-control" name="category" v-model="newTicket.category">
                      <option value="">Choose Category...</option>
                      <option v-for="cat in categories" :value="cat.id">@{{ cat.name }}</option>
                    </select>
                  </div>
                </div>

                <!-- Status -->
                <div class="form-group" :class="{'has-error': newTicket.errors.has('status')}">
                    <label class="col-md-4 control-label">Status</label>
                    <div class="col-md-6">
                        <select class="form-control" name="status" v-model="newTicket.status">
                            <option value="">Choose Status...</option>
                            <option v-for="stat in statuses" :value="stat.id">@{{ stat.name }}</option>
                        </select>
                    </div>
                </div>

                <!-- Priority -->
                <div class="form-group" :class="{'has-error': newTicket.errors.has('priority')}">
                    <label class="col-md-4 control-label">Priority</label>
                    <div class="col-md-6">
                        <select class="form-control" name="priority" v-model="newTicket.priority">
                            <option value="">Choose Priority...</option>
                            <option v-for="pri in priorities" :value="pri.id">@{{ pri.name }}</option>
                        </select>
                    </div>
                </div>
              </div>

              <div class="col-md-8">
                <div class="form-group" :class="{'has-error': newTicket.errors.has('title')}">
                  <label class="col-md-2 control-label">Title</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="title" v-model="newTicket.title" />
                  </div>
                </div>
                <!-- Ticket -->
                <div class="form-group" :class="{'has-error': newTicket.errors.has('message')}">
                    <label class="col-md-2 control-label">Ticket</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="message"  v-model="newTicket.message" rows="6">
                        </textarea>
                    </div>
                </div>

                <!-- Create Button -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6 pull-right">
                        <button class="btn btn-primary" @click.prevent="createTicket" :disabled="newTicket.busy">
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
              <td>
                @{{ ticket.title }}
              </td>
              <!-- Priority -->
              <td>
                @{{ ticket.priority.name }}
              </td>
              <!-- Category -->
              <td>
                @{{ticket.category.name }}
              </td>
              <!-- Status -->
              <td>
                @{{ticket.status.name }}
              </td>

              <!-- Edit Button -->
              <td>
                <button class="btn btn-primary" @click="editTicket(ticket)">
                  <i class="fa fa-pencil"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Edit Announcement Modal -->
    <div class="modal fade" id="modal-update-ticket" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" v-if="updatingTicket">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Update Ticket</h4>
          </div>
          <div class="modal-body">
            <!-- Update Ticket -->
            <form class="form-horizontal" role="form">
              <!-- Ticket -->
              <div class="form-group" :class="{'has-error': updateForm.errors.has('body')}">
                <label class="col-md-4 control-label">Ticket</label>
                <div class="col-md-6">
                  <textarea class="form-control" rows="7" v-model="updateForm.message" style="font-family: monospace;"></textarea>
                  <span class="help-block" v-show="updateForm.errors.has('body')">
                    @{{ updateForm.errors.get('message') }}
                  </span>
                </div>
              </div>
              <!-- Category -->
              <div class="form-group" :class="{'has-error': updateForm.errors.has('category')}">
                <label class="col-md-4 control-label">Action Button Text</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="category" v-model="updateForm.category">
                  <span class="help-block" v-show="updateForm.errors.has('category')">
                    @{{ updateForm.errors.get('category') }}
                  </span>
                </div>
              </div>
            </form>
          </div>

          <!-- Modal Actions -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click="update" :disabled="updateForm.busy">Update</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Announcement Modal -->
    <div class="modal fade" id="modal-delete-ticket" tabindex="-1" role="dialog">
      <div class="modal-dialog" v-if="deletingTicket">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Delete Announcement</h4>
          </div>
          <div class="modal-body">Are you sure you want to delete this announcement?</div>
          <!-- Modal Actions -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No, Go Back</button>
            <button type="button" class="btn btn-danger" @click="deleteTicket" :disabled="deleteForm.busy">Yes, Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</spark-kiosk-tickets>
