import type { FunctionComponent } from "react";
import type { LoansListProps } from "./LoansList.interface";
import Grid from "@mui/material/Unstable_Grid2";
import { LoanItem } from "../LoanItem";

export const LoansList: FunctionComponent<LoansListProps> = ({ loans }) => {
  return (
    <Grid container spacing={2}>
      {loans.map((loan) => (
        <Grid xs={12} sm={6} md={4} key={loan.id}>
          <LoanItem {...loan}></LoanItem>
        </Grid>
      ))}
    </Grid>
  );
};
