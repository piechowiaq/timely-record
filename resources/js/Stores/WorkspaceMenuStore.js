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
