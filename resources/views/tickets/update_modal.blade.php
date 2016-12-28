
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
          <div class="row">
            <div class="col-md-4">
              <!-- User -->
              <div class="form-group" :class="{'has-error': updateForm.errors.has('user_email')}">
                <span class="help-block" v-show="updateForm.errors.has('user_email')">
                  @{{ updateForm.errors.get('user_email') }}
                </span>
                  <label class="col-md-4 control-label">User</label>
                  <div class="col-md-6">
                      <select class="form-control" name="user_email" v-model="updateForm.user_email">
                          <option value="">Choose User...</option>
                          <option v-for="usr in users" :value="usr.email">@{{ usr.name }}</option>
                      </select>
                  </div>
              </div>

              <!-- Category -->
              <div class="form-group" :class="{'has-error': updateForm.errors.has('category')}">
                <span class="help-block" v-show="updateForm.errors.has('category')">
                  @{{ updateForm.errors.get('category') }}
                </span>
                <label class="col-md-4 control-label">Category</label>
                <div class="col-md-6">
                  <select class="form-control" name="category" v-model="updateForm.category">
                    <option value="">Choose Category...</option>
                    <option v-for="cat in categories" :value="cat.id">@{{ cat.name }}</option>
                  </select>
                </div>
              </div>

              <!-- Status -->
              <div class="form-group" :class="{'has-error': updateForm.errors.has('status')}">
                  <label class="col-md-4 control-label">Status</label>
                  <div class="col-md-6">
                      <select class="form-control" name="status" v-model="updateForm.status">
                          <option value="">Choose Status...</option>
                          <option v-for="stat in statuses" :value="stat.id">@{{ stat.name }}</option>
                      </select>
                  </div>
              </div>

              <!-- Priority -->
              <div class="form-group" :class="{'has-error': updateForm.errors.has('priority')}">
                  <label class="col-md-4 control-label">Priority</label>
                  <div class="col-md-6">
                      <select class="form-control" name="priority" v-model="updateForm.priority">
                          <option value="">Choose Priority...</option>
                          <option v-for="pri in priorities" :value="pri.id">@{{ pri.name }}</option>
                      </select>
                  </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="form-group" :class="{'has-error': updateForm.errors.has('title')}">
                <label class="col-md-2 control-label">Title</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="title" v-model="updateForm.title" />
                </div>
              </div>
              <!-- Ticket -->
              <div class="form-group" :class="{'has-error': updateForm.errors.has('message')}">
                  <label class="col-md-2 control-label">Ticket</label>
                  <div class="col-md-10">
                      <textarea class="form-control" name="message"  v-model="updateForm.message" rows="6">
                      </textarea>
                  </div>
              </div>
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
