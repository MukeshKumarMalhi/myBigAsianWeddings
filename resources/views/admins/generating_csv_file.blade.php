<div class="table-responsive small">
                  <table class="table table-condensed" id="userTable">
                      <thead>
                          <tr>
                              <th><span>Name</span></th>
                              <th><span>Email</span></th>
                              <th><span>Phone</span></th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                           <?php if(isset($data) && count($data) > 0){ ?>
                             @foreach($data as $value)
                               <tr>
                                 <td>{{ isset($value->name) ? $value->name : '-' }}</td>
                                 <td>{{ isset($value->email) ? $value->email : '-' }}</td>
                                 <td>{{ isset($value->phone) ? $value->phone : '-' }}</td>
                               </tr>
                             @endforeach
                          <?php }?>
                      </tbody>
                  </table>
              </div>