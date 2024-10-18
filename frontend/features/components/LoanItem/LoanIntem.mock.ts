import type { LoanItemProps } from "./LoanItem.interface";

export const loanItem: LoanItemProps = {
  id: "db28d26a-20e7-3072-a2a8-0bb58dae5910",
  loaned_book: {
    id: "db28d26a-20e7-3072-a2a8-0bb58dae59a9",
    title: "The System of Doctor Tarr and Professor Fether",
    publisher: "OldSchool",
    author: {
      id: "d505a8d4-81e1-36e1-9f88-a591a9bd606c",
      name: "Edgar Allan Poe",
    },
    createdAt: "2024-08-16T14:39:16+00:00",
    updatedAt: "2024-08-16T14:39:16+00:00",
  },
  loan_date: "2024-06-24",
  return_date: "2024-06-26",
};
