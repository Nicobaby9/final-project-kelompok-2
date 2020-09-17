import createCategory from '../views/Category/CreateCategory'
import category from '../views/Category/Category'
import editCategory from '../views/Category/EditCategory'


const routes = [{
        path: '/category',
        name: 'category',
        component: category
    }, {
        path: '/category/create',
        name: 'createCat',
        component: createCategory
    },
    {
        path: '/category/edit/:id',
        name: 'editCat',
        component: editCategory
    }
]

export default {
    mode: 'history',
    linkActiveClass: 'bg-primary text-white',
    routes
}
