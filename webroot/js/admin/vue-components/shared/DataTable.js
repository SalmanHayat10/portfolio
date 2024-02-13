app.component('data-table', {
    props: {
        model: {
            type: String,
            default: null
        },
        // deleteApi: String,
        headers: Array,
        hasCheckbox: Boolean,
        datakey: {
            type: String,
            default: 'datatable'
        },
        baseUrl: {
            type: String,
            default: BASE_URL + 'asgard/'
        },
        headerActions: {
            type: Array,
            default: []
        },
        limit: {
            type: Number,
            default: 20
        },
        query: {
            type: Object,
            default: {
                where: {
                    is_deleted: 0
                }
            }
        },
        recoverSec: {
            type: String,
            default: '10'
        },
        isExpand: {
            type: Boolean,
            default: false
        },
        singleExpand: {
            type: Boolean,
            default: true
        },
        search: {
            type: Object,
            default: {}
        }
    },
    template: document.getElementById('data-table').innerHTML,
    data() {
        return {
            pages: 0,
            currentPage: 1,
            totalPages: 0,
            results: [],
            start: 0,
            end: 0,
            total: 0,
            loading: false,
            allChecked: false,
            allCheckIndeterminate: false,
            selectedResults: [],
            deletedResults: [],
            // Used for showing warning messages
            warningMsg: null,
            sorting: {},
            extraQuery: {},
            searchField: 'all',
            searchQuery: null
        }
    },
    methods: {
        onRenderValue(result, header) {
            // console.log("Result : ",result);
            // console.log("Header: ", header);
            if (header.displayAs && typeof header.displayAs == 'function') {
                // console.log("Display As: ");
                return header.displayAs(result);
            }

            if (header.field) {
                //if date format specified
                const currentValue = _.get(result, header.field, 'not found');
                if (header.dateFormat && !header.isAction) {
                    return moment(currentValue).format(header.dateFormat);
                }
                if (!header.isAction) {
                    return currentValue;
                }
            }

            if (header.isAction) {
                const actions = [];
                if (header.viewUrl && typeof header.viewUrl == 'function') {
                    const url = header.viewUrl(result);
                    actions.push({ url: this.baseUrl + url, icon: 'visibility', tooltip: 'View' });
                }
                if (header.editUrl) {
                    const url = header.editUrl(result);
                    actions.push({ url: this.baseUrl + url, icon: '', tooltip: 'Edit' });
                }
                if (header.isDelete) {
                    actions.push({ url: 'javascript:void(0)', isDelete: true, icon: '', tooltip: 'Delete' });
                }
                // console.log("Actions: ", actions);
                return actions;
            }
        },
        //Editable Logic
        onDisplayEditableInput(result, header) {
            result.showEditable = !result.showEditable;
        },
        async onInputEdit(e, result, header) { //onEnter will called
            const newValue = e.target.value;
            if (header.type === 'date') {
                result[header.field] = moment(newValue).format('YYYY-MM-DD');
            } else if (header.type === 'datetime') {
                result[header.field] = moment(newValue).format('YYYY-MM-DD HH:mm:ss');
            } else {
                result[header.field] = newValue;
            }
            result.showEditable = false;
            await saveData(this.model, { id: result.id, [header.field]: newValue });
            showSuccessMessage('Record updated.');
        },
        //Editable Logic Ends here
        onRenderCustomActions(result, header) {
            const customActions = [];
            const context = this;
            //Toggle Action
            if (header.isAction && header.isToggle === true) {
                const text = result[header.field] ? '<span style="color: green;">Yes</span>' : '<span style="color: red;">No</span>';
                const icon = result[header.field] ? 'check_circle' : 'done';
                customActions.push({
                    text,
                    icon,
                    handler: async(result) => {
                        await saveData(context.model, { id: result.id, [header.field]: !result[header.field] });
                        context.getData(context.currentPage);
                    }
                });
                return customActions;
            }
            //Custom actions
            if (header.isAction && header.actions && _.get(header, 'actions.length', 0) > 0) {
                const { actions } = header;
                actions.map((item) => {
                    const text = typeof _.get(item, 'text', null) === 'function' ? item.text(result) : item.text;
                    const icon = typeof _.get(item, 'icon', null) === 'function' ? item.icon(result) : item.icon;
                    const url = typeof _.get(item, 'url', null) === 'function' ? item.url(result) : item.url;
                    customActions.push({
                        ...item,
                        text,
                        icon,
                        url
                    });
                })
                return customActions;
            }
        },
        async onRowDelete(result) {
            if (confirm('Are you sure? You want to delete this record?')) {
                try {
                    const resp = await softDelete(this.model, { where: { id: result.id } });
                    if (resp.success) {
                        this.addToSession(resp.data);
                        showSuccessMessage('Record successfully deleted.', 5 * 1000);
                        this.getData(this.currentPage); //Reload data
                    }
                } catch (error) {
                    console.error(`[DataTable] [${this.deleteApi}] Error: `, error);
                }
            }
            console.log("Row Delete: ", result);
        },
        async getData(page = 1) {
            try {
                this.loading = true;
                const resp = await getPagination(this.model, { where: _.get(this.query, 'where', {}), ...this.query, page, limit: this.limit, ...this.extraQuery });
                if (resp.success) {
                    const { pagesCount, results, total } = resp.data;
                    this.totalPages = pagesCount;
                    this.results = results;
                    this.total = total;
                    this.onNumberedPages(pagesCount);
                    //Pagination
                    this.start = this.currentPage === 1 ? 1 : ((this.currentPage - 1) * this.limit) + 1;
                    if (this.currentPage === 1 && this.total === 0) {
                        this.start = 0;
                    }
                    if (total <= (this.limit * this.currentPage)) {
                        this.end = this.total;
                    } else {
                        this.end = (this.currentPage) * (this.limit);
                    }
                }
                this.loading = false;
            } catch (error) {
                this.loading = false;
                console.error(`[DataTable] [${this.model}] Error: `, error);
            }
        },
        onNumberedPages(pagesCount = 0) {
            const tmpPages = [];
            let startPage = 1,
                endPage = pagesCount;
            startPage = this.currentPage - 4;
            if (startPage < 1) {
                startPage = 1;
            }
            endPage = this.currentPage + 4;
            if (endPage < 10) {
                endPage = 10;
            }
            if (endPage > pagesCount) {
                endPage = pagesCount;
            }
            const diff = this.currentPage - endPage;
            if (diff > -4) {
                startPage = pagesCount - 8;
            }
            if (startPage <= 0) {
                startPage = 1;
            }
            for (let i = startPage; i <= endPage; i++) {
                tmpPages.push(i);
            }
            this.pages = tmpPages;
        },
        onPage(page = 1) {
            console.log("Page: ", page);
            if (this.currentPage !== page) {
                this.getData(page);
            }
            this.currentPage = page;
        },
        onNextPage() {
            console.log("onNextPage: ", this.currentPage + 1);
            this.getData(this.currentPage + 1);
            this.currentPage++;
        },
        onPreviousPage() {
            console.log("onPreviousPage: ", this.currentPage - 1);
            this.getData(this.currentPage - 1);
            this.currentPage--;
        },
        //checkbox
        onAllCheck() {
            this.selectedResults = [];
            this.results.map((item) => {
                item.isChecked = this.allChecked;
                if (this.allChecked) {
                    this.selectedResults.push(item);
                }
            });
        },
        onSingleCheck(e, item) {
            if (item.isChecked) {
                this.selectedResults.push(item);
            } else {
                this.selectedResults = this.selectedResults.filter((val) => val.id !== item.id);
            }
            //Header checkbox
            if (_.get(this.selectedResults, 'length', 0) === _.get(this.results, 'length', 0)) {
                this.allCheckIndeterminate = false;
                this.allChecked = true;
            } else if (_.get(this.selectedResults, 'length', 0) === 0) {
                this.allCheckIndeterminate = false;
                this.allChecked = false;
            } else {
                this.allCheckIndeterminate = true;
            }
        },
        async onDeleteSelected() {
            if (confirm('Are you sure? You want to delete selected records?')) {
                const selectedIds = [];
                this.selectedResults.map((result) => {
                    selectedIds.push(result.id);
                });
                const resp = await softDelete(this.model, { where: { 'id IN': selectedIds } });
                if (resp.success) {
                    this.addToSession(resp.data);
                    this.getData(this.currentPage);
                    this.selectedResults = [];
                    this.allChecked = false;
                    showSuccessMessage(`${resp.total} records are successfully deleted.`, 5 * 1000);
                }
            }
        },
        addToSession(data = []) {
            const recordKey = location.pathname;
            const ids = [];
            data.map((item) => ids.push(item.id));
            this.deletedResults = ids;
            sessionStorage.setItem(recordKey, JSON.stringify(ids));
            this.recoverTimer();
        },
        getFromSession() {
            const recordKey = location.pathname;
            const tmp = sessionStorage.getItem(recordKey);
            if (tmp) {
                this.recoverTimer();
                this.deletedResults = JSON.parse(tmp);
            }
        },
        removeFromSession() {
            const recordKey = location.pathname;
            sessionStorage.removeItem(recordKey);
            this.deletedResults = [];
        },
        recoverTimer() {
            setTimeout(() => {
                this.removeFromSession();
            }, parseInt(this.recoverSec) * 1000);
        },
        async recoverDeleted() {
            if  (_.get(this.deletedResults, 'length', 0) > 0) {
                const resp = await recoverDelete(this.model, { where: { 'id IN': this.deletedResults }});
                if (resp.success) {
                    this.getData(this.currentPage);
                    this.deletedResults = [];
                    this.removeFromSession();
                    showSuccessMessage(`${resp.total} records successfully recovered.`, 5 * 1000);
                }
            }
        },
        toggleExpand(e, result) {
            if (this.isExpand) {
                if (this.singleExpand) {
                    this.results.map((item) => {
                        if (item.id != result.id) {
                            item.isExpand = false;
                        }
                    });
                    result.isExpand = !result.isExpand;
                } else {
                    result.isExpand = !result.isExpand;
                }
            }
        },
        // Sorting
        //--------------------
        onSort(field) {
            console.log("Field: ", field);
            let fieldName = field.indexOf('.') === -1 ? this.model + '.' + field : field;
            let sortBy = false;
            if (!this.sorting[field]) {
                this.sorting[field] = 'ASC';
                sortBy = true;
            } else if (this.sorting[field] && this.sorting[field] === 'ASC') {
                this.sorting[field] = 'DESC';
                sortBy = true;
            } else if (this.sorting[field] && this.sorting[field] === 'DESC') {
                //remove filter
                delete this.sorting[field];
            }

            if (sortBy) {
                this.extraQuery = {
                    ...this.extraQuery,
                    order: { 
                        ...this.extraQuery.order,
                        [fieldName]: this.sorting[field] 
                    }
                }
            } else {
                delete this.extraQuery.order[fieldName];
            }

            //ReLoad the data
            this.getData(1);
            this.currentPage = 1;
        },
        // \ Sorting Ends here
        // Searching
        onSearch() {

            let searchCond = {};
            let allQuery = {};
            let fieldTypes = {};
            
            const numTypes = ['int','integer','number','numeric'];
            if (this.searchField == 'all') {
                const whereConditions = [];
                this.search.map((itm) => {                        
                    const tmpWhere = {
                        [itm.field + ' LIKE']: '%' + _.trim(this.searchQuery) + '%'
                    }
                    if (numTypes.indexOf(itm.type ? itm.type.toLowerCase() : '') > -1) {
                        fieldTypes = {
                            ...fieldTypes,
                            [itm.field]: 'string'
                        }
                    }
                    whereConditions.push(tmpWhere);
                })
                allQuery = {
                    where: {
                        ...this.query && this.query.where ? this.query.where : {},
                        OR: whereConditions 
                    },
                    fieldTypes
                }
            } else {
                const tmpSearch = this.search.find((itm) => itm.field === this.searchField);
                if (numTypes.indexOf(tmpSearch.type ? tmpSearch.type.toLowerCase() : '') > -1) {
                    allQuery = {
                        fieldTypes: {
                            [tmpSearch.field]: 'string'
                        }
                    }
                }
                searchCond = {
                    [this.searchField + ' LIKE']: '%' + _.trim(this.searchQuery) + '%'
                }
            }
            this.extraQuery = {
                ...this.extraQuery,
                where: {
                    ...this.query && this.query.where ? this.query.where : {},
                    ...searchCond
                },
                ...allQuery
            }
            this.getData(1);
            this.currentPage = 1;
        }
    },
    mounted() {
        try {
            if (!this.model) {
                this.loading = false;
                this.warningMsg = 'Please specify model="modelName" name in component.';
                return false;
            }
            this.getData();
            console.log("DataTable component loaded.");
            //Reload record from session
            this.getFromSession();
        } catch (error) {
            console.log("DataTable: ", error);
        }
    }
});