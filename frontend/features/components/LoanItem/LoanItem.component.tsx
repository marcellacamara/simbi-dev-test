"use client";

import { useState, type FunctionComponent } from "react";
import type { LoanItemProps } from "./LoanItem.interface";
import {
  Card,
  CardContent,
  CardActions,
  Button,
  Typography,
  Tooltip,
} from "@mui/material";
import formatDateDisplay from "@/common/utils/formatDateDisplay";
import unloanBook from "@/services/unloanBook";

export const LoanItem: FunctionComponent<LoanItemProps> = (
  loan: LoanItemProps
) => {
  const [unloanProcess, setUnloanProcess] = useState<{
    isUnloaning: boolean;
    message: string;
  }>({ isUnloaning: false, message: "Aguarde" });

  const handleUnloanBookAction = async (loanId: string) => {
    setUnloanProcess({ isUnloaning: true, message: "Emprestando Livro" });

    try {
      await unloanBook(loanId);
      setUnloanProcess({ isUnloaning: true, message: "Livro disponível" });
    } catch (error) {
      setUnloanProcess({
        isUnloaning: true,
        message: "Infelizmente ocorreu Um Erro ",
      });
    }
    setTimeout(
      () => setUnloanProcess({ isUnloaning: false, message: "Aguarde" }),
      1500
    );
  };

  return (
    <Card variant="outlined">
      <CardContent>
        <Tooltip title={loan.loaned_book.title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {loan.loaned_book.title}
          </Typography>
        </Tooltip>
        {unloanProcess.isUnloaning && (
          <Typography variant="body2">{unloanProcess.message}</Typography>
        )}
        <Typography variant="body2" color="text.secondary">
          De {formatDateDisplay(loan.loan_date)} até{" "}
          {formatDateDisplay(loan.return_date)}
        </Typography>
      </CardContent>
      <CardActions>
        <Button
          size="small"
          variant="contained"
          fullWidth
          onClick={() => handleUnloanBookAction(loan.id)}
        >
          Devolver
        </Button>
      </CardActions>
    </Card>
  );
};
