import { defineStore } from "pinia";

// Constants
const ADMIN_OPTIONS = {
    name: 'Admin',
    route: 'admin.dashboard',
    icon: 'admin'
};

const MULTIPLE_COMPANIES_OPTIONS = {
    name: 'Switch Workspace',
    route: 'project.dashboard',
    icon: 'workspace'
};

const MENU_OPTIONS = [
    { name: 'Dashboard', route: 'workspaces.show', icon: 'dashboard' },
    { name: 'Registries', route: 'workspace.registries.index', icon: 'registries' },
];

export const useWorkspaceMenuStore = defineStore("WorkspaceMenuStore",{
    state: () => ({
        user: null,
        workspacesCount: 0,
        options: MENU_OPTIONS,
    }),
    getters: {
        isSuperAdmin(state) {
            return state.user && state.user.id === 1 || false;
        },
        superAdminOptions() {
            return ADMIN_OPTIONS;
        },
        hasMultipleWorkspaces(state) {
            return state.workspacesCount > 1 || false;
        },
        multipleWorkspacesOptions() {
            return MULTIPLE_COMPANIES_OPTIONS;
        }
    },
    actions: {
        setUser(user) {
            this.user = user;
        },
        setWorkspacesCount(count) {
            this.workspacesCount = count;
        },
    }
});
