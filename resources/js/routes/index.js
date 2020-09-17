import createCategory from '../views/Category/CreateCategory'
import category from '../views/Category/Category'
import editCategory from '../views/Category/EditCategory'

import createProduct from '../views/Products/CreateProduct'
import product from '../views/Products/Product'
import editProduct from '../views/Products/EditProduct'


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
    },
    {
        path: '/products',
        name: 'products',
        component: product
    },
    {
        path: '/products/create',
        name: 'createProd',
        component: createProduct
    },
    {
        path: '/products/edit/:id',
        name: 'editProd',
        component: editProduct
    },
]

export default {
    mode: 'history',
    linkActiveClass: 'bg-primary text-white',
    routes
}
