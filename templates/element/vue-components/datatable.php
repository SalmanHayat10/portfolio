<div id="data-table">
  <div class="data-table">
    <div class="row">
      <div class="col">
        <div class="card card-small mb-4">
          <!-- 
          <div class="card-header border-bottom">
            <h6 class="m-0">Active Records</h6>
          </div> 
          -->
          <div class="p-0 text-center">
            <div class="d-flex flex-column" :id="'card' + datakey">
              <!-- Number of records selected -->
              <div v-if="selectedResults.length > 0">
                <div class="alert bg-color text-left" role="alert">
                  <div class="row">
                    <div class="col d-flex align-items-center">
                      {{selectedResults.length}} {{selectedResults.length === 1 ? 'record is' : 'records are'}} selected.
                    </div>
                    <div class="col text-right">
                      <a href="javascript:void(0)" class="btn active-light btn-danger" data-toggle="tooltip" title="Delete selected records" @click="() => onDeleteSelected()">
                        <i class="material-icons white"></i>
                        Delete selected
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Recover Deleted Records -->
              <div v-if="deletedResults.length > 0">
                <div class="alert bg-color text-left" role="alert">
                <div class="row">
                    <div class="col d-flex align-items-center">
                      Recover {{deletedResults.length}} deleted records.
                    </div>
                    <div class="col text-right">
                      <a href="javascript:void(0)" class="btn active-light btn-success" data-toggle="tooltip" title="Recover deleted records" @click="() => recoverDeleted()">
                        <i class="material-icons white">undo</i>
                        Recover deleted
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Search & Filter -->
              <div class="row justify-content-end align-items-center pr-3">
                <!-- <div v-for="(action, actionIdx) in headerActions" class="col-lg-2 col-sm-4 col-md-3 d-flex justify-content-end p-1">
                  <a class="btn" :class="action.class" :href="action.url ? action.url : 'javascript:void(0)'" @click="() => action.handler ? action.handler() : null" data-toggle="tooltip" :title="action.text">
                    <i class="material-icons">{{action.icon}}</i>
                    <span>{{action.text}}</span>
                  </a>
                </div> -->

                <div class="col-12 col-md-4" v-if="search && search.length > 0">
                  <div class="pt-2 pl-2">
                    <div class="input-group">
                      <select class="form-control rounded-0" style="height: inherit !important;" v-model="searchField">
                        <option selected value="all">All</option>
                        <option v-for="(val, idx) in search" :value="val.field">{{val.text}}</option>
                      </select>
                      <input type="text" class="form-control" placeholder="Search..." @keydown.enter="onSearch" v-model="searchQuery" />
                      <button class="btn btn-primary rounded-0" @click="onSearch">
                        <i class="material-icons" style="font-size: 14px;">search</i>
                      </button>
                      <!-- <button class="btn btn-primary rounded-0">
                        <i class="material-icons" style="font-size: 14px;">filter_alt</i>
                      </button> -->
                    </div>
                  </div>
                </div>

                <div class="btn-group mr-2 pt-2" v-if="headerActions && headerActions.length > 0">
                  <a :href="headerActions[0].url ? headerActions[0].url : 'javascript:void(0)'" @click="() => headerActions[0].handler ? headerActions[0].handler() : null" class="btn rounded-0 btn-primary" data-toggle="tooltip" :title="headerActions[0].text">
                    <i class="material-icons">{{headerActions[0].icon}}</i>
                    <span>{{headerActions[0].text}}</span>
                  </a>
                  <button type="button" v-if="headerActions && headerActions.length > 1 && headerActions[1].text && headerActions[1].url" class="btn rounded-0 btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" :class="action.class" v-for="(action, actionIdx) in headerActions.slice(1, headerActions.length)" :href="action.url ? action.url : 'javascript:void(0)'" @click="() => action.handler ? action.handler() : null" data-toggle="tooltip" :title="action.text">
                      <i class="material-icons">{{action.icon}}</i>&nbsp;
                      <span>{{action.text}}</span>
                    </a>
                  </div>
                </div>

              </div>

              <!-- <div class="row pt-2">
                <div class="col-12">
                  <span class="ml-1 mr-1 badge badge-pill badge-primary">Name: Sufyan &nbsp; <a href="javascript:void(0)" style="font-size: 10px;border-radius: 50px;" class="badge bg-white badge-primary text-dark"><span class="material-icons" style="font-size: inherit;">clear</span></a></span>
                  <span class="ml-1 mr-1 badge badge-pill badge-primary">Name: Sufyan &nbsp; <a href="javascript:void(0)" style="font-size: 10px;border-radius: 50px;" class="badge bg-white badge-primary text-dark"><span class="material-icons" style="font-size: inherit;">clear</span></a></span>
                  <span class="ml-1 mr-1 badge badge-pill badge-primary">Name: Sufyan &nbsp; <a href="javascript:void(0)" style="font-size: 10px;border-radius: 50px;" class="badge bg-white badge-primary text-dark"><span class="material-icons" style="font-size: inherit;">clear</span></a></span>


                </div>
              </div> -->

              <div class="table-responsive">

                <table :id="datakey" class="table mb-0">
                  <thead class="bg-light">
                    <tr>
                      <th v-if="hasCheckbox || isExpand" scope="col" class="border-0 front-box-container">
                        <div v-if="hasCheckbox" class="custom-control custom-checkbox mb-1">
                          <input type="checkbox" class="custom-control-input" id="all-checked" :indeterminate.sync="allCheckIndeterminate" v-model="allChecked" @change="onAllCheck" type="checkbox" />
                          <label class="custom-control-label" for="all-checked"></label>
                        </div>
                        <div v-if="isExpand" class="expand-btn">
                        </div>
                      </th>
                      <th scope="col" class="border-0 table-heading" v-for="(header, idx) in headers" :key="idx">
                        <span class="cursor-pointer" @click="() => header && header.sort ? onSort(header.field) : null">{{header.text}}</span>
                        <i aria-hidden="true" class="material-icons" style="font-size: 13px;" v-if="header && header.sort">
                          {{sorting[header.field] && sorting[header.field] == 'ASC' ? 'arrow_downward' : null}}
                          {{sorting[header.field] && sorting[header.field] == 'DESC' ? 'arrow_upward' : null}}
                          {{!sorting[header.field] ? 'swap_vert' : null}}
                        </i>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <template v-for="(result, idx) in results" :key="result.id">
                      <tr :class="result.isChecked ? 'selected-row' : 'table-row'">
                        <td v-if="hasCheckbox || isExpand" class="front-box-container">
                          <div v-if="hasCheckbox" class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" :id="'check' + result.id" v-model="result.isChecked" @change="(e) => onSingleCheck(e, result)" type="checkbox" />
                            <label class="custom-control-label" :for="'check' + result.id"></label>
                          </div>
                          <div v-if="isExpand" @click.stop="(e)=> toggleExpand(e, result)">
                            <button v-if="result.isExpand" class="btn expand-btn">
                              <i class="fas fa-chevron-up"></i>
                            </button>
                            <button v-else class="btn expand-btn">
                              <i class="fas fa-chevron-down"></i>
                            </button>
                          </div>
                        </td>
                        <td v-for="(header, hIdx) in headers" :key="result.id + hIdx">

                          <div v-if="header.isAction" class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Table row actions">

                            <div v-if="header.isEditable">
                              <div v-if="!result.showEditable" @dblclick.stop="() => onDisplayEditableInput(result, header)">
                                <span v-if="header.dateFormat">{{moment(result[header.field]).format(header.dateFormat)}}</span>
                                <span v-else>{{result[header.field]}}</span>
                              </div>
                              <div v-else>
                                <input v-if="header.type && header.type == 'date'" type="date" class="form-control" :value="moment(result[header.field]).format('YYYY-MM-DD')" @change="(e) => onInputEdit(e, result, header)" />
                                <input v-else-if="header.type && header.type == 'datetime'" type="datetime-local" class="form-control" :value="moment(result[header.field]).format('YYYY-MM-DDTHH:mm:ss')" @change="(e) => onInputEdit(e, result, header)" />
                                <input v-else-if="header.type && (header.type == 'number' || header.type == 'integer')" type="number" class="form-control" :value="result[header.field]" v-on:keyup.enter="(e) => onInputEdit(e, result, header)" />
                                <input v-else type="text" class="form-control" :value="result[header.field]" v-on:keyup.enter="(e) => onInputEdit(e, result, header)" />
                              </div>
                            </div>

                            <a v-for="(action, actionIdx) in onRenderValue(result, header)" :href="action.url" class="btn active-light" :class="action.isDelete ? 'btn-danger' : 'btn-white'" data-toggle="tooltip" :title="action.tooltip" @click.stop="() => action.isDelete ? onRowDelete(result) : null">
                              <i class="material-icons white">{{action.icon}}</i>
                            </a>

                            <!-- Custom Actions -->
                            <a v-for="(action, actionIdx) in onRenderCustomActions(result, header)" :href="action.url ? action.url : 'javascript:void(0)'" class="btn active-light" :class="action.isDelete ? 'btn-danger' : 'btn-white'" data-toggle="tooltip" :title="action.tooltip" @click.stop="() => action.handler ? action.handler(result) : null" style="display: flex;justify-content: center;align-items: flex-start;">
                              <i v-if="action.icon" class="material-icons white">{{action.icon}}</i>
                              <span v-if="action.text" style="padding-left: 3px;" v-html="action.text"></span>
                            </a>

                          </div>
                          <span v-else v-html="onRenderValue(result, header)"></span>
                        </td>
                      </tr>
                      <tr v-if="isExpand && result.isExpand">
                        <td :colspan="headers.length + 1">
                          <slot name="expand" :item="result"></slot>
                        </td>
                      </tr>
                    </template>

                  </tbody>
                </table>
              </div>

              <div v-if="warningMsg" class="d-flex justify-content-center align-items-center">
                {{warningMsg}}
              </div>
              <div v-if="loading" class="d-flex justify-content-center align-items-center">
                <div class="loading-spinner">
                  <div class="rect1"></div>
                  <div class="rect2"></div>
                  <div class="rect3"></div>
                  <div class="rect4"></div>
                  <div class="rect5"></div>
                </div>
              </div>
            </div>
            <div class="card-footer" style="background: #fbfbfb;">
              <!-- Pagination -->
              <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-sm-12 col-md-5 d-flex footer-records-info">
                  Showing {{start}} to {{end}} of {{total}} entries
                </div>
                <div class="col-12 col-sm-12 col-md-7">
                  <div class="dataTables_paginate paging_simple_numbers d-flex footer-pagination">
                    <ul class="pagination" style="margin: 0;">
                      <li class="paginate_button page-item first" v-if="currentPage > 1" :class="currentPage === 1 || loading ? 'disabled' : ''">
                        <a href="javascript:void(0)" @click="() => onPage(1)" class="page-link">First</a>
                      </li>
                      <li class="paginate_button page-item previous" :class="currentPage === 1 || loading ? 'disabled' : ''">
                        <a href="javascript:void(0)" @click="onPreviousPage" class="page-link">Prev</a>
                      </li>
                      <li class="paginate_button page-item" v-for="(page) in pages" :key="'page'+page" :class="currentPage === page ? 'active' : ''">
                        <a href="javascript:void(0)" style="min-width: 40px;" @click="() => onPage(page)" class="page-link">{{page}}</a>
                      </li>
                      <li class="paginate_button page-item next" :class="(end) >= total || loading ? 'disabled' : ''">
                        <a href="javascript:void(0)" @click="onNextPage" class="page-link">Next</a>
                      </li>
                      <li class="paginate_button page-item first" v-if="currentPage < totalPages" :class="(end) >= total || loading ? 'disabled' : ''">
                        <a href="javascript:void(0)" @click="() => onPage(totalPages)" class="page-link">Last</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>