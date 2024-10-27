/// <reference types="cypress" />

describe('User can Open Login Page and Interact with Form', () => {
    beforeEach(() => {
        cy.visit("http://127.0.0.1:8000/login");
    });

    it('Login Page Can Be Open and have Correct Specification', () => {
        cy.title().should('eq', 'Sign In | Parmajoy');
        cy.get('form#deliveryForm').should('have.attr', 'method', 'POST');
        cy.get('input[name="_token"]').should('exist');
    });

    it('Login Form has Email and Password Fields with Correct Placeholders', () => {
        cy.get('input[name="email"]')
            .should('exist')
            .should('have.attr', 'placeholder', 'Your email address')
            .should('have.class', 'form-input')
            .should('have.css', 'background-image')
            .and('include', 'ic-email.svg');

        cy.get('input[name="password"]')
            .should('exist')
            .should('have.attr', 'placeholder', 'Protect your password')
            .should('have.class', 'form-input')
            .should('have.css', 'background-image')
            .and('include', 'ic-lock.svg');
    });

    it('Login Form has Submit Button with Correct Styles and Redirection', () => {
        cy.get('button[type="submit"]')
            .should('have.class', 'text-white')
            .should('have.class', 'bg-primary')
            .should('have.class', 'rounded-full')
            .should('have.css', 'padding')
            .and('include', '30px');
    });
});
