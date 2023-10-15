// import { defineStore } from "pinia";
//
// export const useWorkspaceMenuStore = defineStore("WorkspaceMenuStore", {
//     state: () => ({
//         user: null, // Assume you have a way to set this, perhaps from an API call or another store
//         companiesCount: 0, // As above
//         options: [
//             { name: 'Dashboard', route: 'workspace.dashboard', icon: 'dashboard', active: true },
//             { name: 'Registries', route: 'workspace.registries.index', icon: 'registries', active: true },
//         ],
//         isSuperAdmin:  { name: 'Admin', route: 'admin.dashboard', icon: 'admin', active: false }, // Set dynamically later,
//         hasMultipleCompanies:  { name: 'Workspace', route: 'workspace.selector', icon: 'workspace', active: false }, // Set dynamically later
//     }),
//     getters: {
//         isSuperAdmin: (state) => state.user && state.user.id === 1,
//         hasMultipleCompanies: (state) => state.companiesCount > 1,
//     },
//     actions: {
//         // Define actions to set user and companiesCount if needed
//         setUser(user) {
//             this.user = user;
//         },
//         setCompaniesCount(count) {
//             this.companiesCount = count;
//         },
//         initializeOptions() {
//             this.options.find(option => option.name === 'Admin').active = this.isSuperAdmin;
//             this.options.find(option => option.name === 'Workspace').active = !this.isSuperAdmin && this.hasMultipleCompanies;
//         }
//     }
// });
import { defineStore } from "pinia";

// Constants
const ADMIN_OPTIONS = {
    name: 'Admin',
    route: 'admin.dashboard',
    icon: 'admin'
};

const MULTIPLE_COMPANIES_OPTIONS = {
    name: 'Switch Workspace',
    route: 'workspace.selector',
    icon: 'workspace'
};

const MENU_OPTIONS = [
    { name: 'Dashboard', route: 'workspace.dashboard', icon: 'dashboard' },
    { name: 'Registries', route: 'workspace.registries.index', icon: 'registries' },
];

export const useWorkspaceMenuStore = defineStore("WorkspaceMenuStore",{
    state: () => ({
        user: null,
        companiesCount: 0,
        options: MENU_OPTIONS,
    }),
    getters: {
        isSuperAdmin(state) {
            return state.user && state.user.id === 1 || false;
        },
        superAdminOptions() {
            return ADMIN_OPTIONS;
        },
        hasMultipleCompanies(state) {
            return state.companiesCount > 1 || false;
        },
        multipleCompaniesOptions() {
            return MULTIPLE_COMPANIES_OPTIONS;
        }
    },
    actions: {
        setUser(user) {
            this.user = user;
        },
        setCompaniesCount(count) {
            this.companiesCount = count;
        },
    }
});
