# Smart Budget and Expense Tracker

The **Smart Budget and Expense Tracker** is a web-based application designed to help users manage their personal finances efficiently. It allows users to log their income and expenses, set budgets, track financial trends, generate reports, and predict future expenses using weighted averages.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)

## Features

### 1. **Income and Expense Logging**
   - Users can log all their income and expense transactions, categorized by type (e.g., salary, rent, groceries).
   - Transactions are recorded with the date, category, amount, and optional notes.

### 2. **Budget Allocation**
   - Users can allocate budgets to different categories (e.g., food, transport) and set limits on spending.
   - The system tracks spending against the allocated budget to provide insights into remaining funds.

### 3. **Monthly Report Generation**
   - The app generates monthly reports that summarize the user’s income, expenses, and budget performance.
   - Reports are displayed in a clear, organized format, helping users understand their financial patterns.

### 4. **Expense Prediction**
   - The system predicts future expenses using a **weighted moving average** based on the past three months of spending.
   - Recent months are given more weight, making predictions more accurate.

### 5. **Customizable Budget Alerts**
   - Users receive alerts when they are close to exceeding their budget in specific categories.
   - These alerts help users stay on track with their financial goals.

### 6. **Currency Conversion**
   - Users can convert expenses into different currencies based on real-time exchange rates.
   - This feature is especially useful for users who travel or manage finances in multiple currencies.

### 7. **Expense Splitting**
   - Users can split expenses among multiple categories or individuals (e.g., roommates, family members).
   - This is useful for shared expenses like rent or groceries.

### 8. **Transaction Notes**
   - Users can add detailed notes to individual transactions for better record-keeping.
   - Notes allow users to describe the context of the expense or income, improving clarity.

### 9. **Login/Logout System**
   - Users can create accounts and log in to access their personal data.
   - Each user’s transactions, budgets, and preferences are securely stored in a database.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL (phpMyAdmin)
- **Libraries**: Chart.js (for report visualizations)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/smart-budget-tracker.git
