"use client";

import { useState, type FunctionComponent } from "react";
import type { BookItemProps } from "./BookItem.interface";
import {
  Card,
  CardContent,
  CardMedia,
  CardActions,
  Button,
  Typography,
  Tooltip,
} from "@mui/material";

import loanBook from "@/services/loanBook";
import formatDateApi from "@/common/utils/formatDateApi";

export const BookItem: FunctionComponent<BookItemProps> = ({
  title,
  coverUrl,
  id,
}) => {
  const [loanStatus, setLoanStatus] = useState<{
    isProcessing: boolean;
    feedback: string;
  }>({ isProcessing: false, feedback: "Por favor, aguarde" });

  const handleLoanBookAction = async (bookId: string) => {
    setLoanStatus({
      isProcessing: true,
      feedback: "Processando empréstimo...",
    });
    const today = new Date();
    const formattedToday = formatDateApi(today);

    const returnDate = new Date();
    returnDate.setDate(today.getDate() + 8);
    const formattedReturnDate = formatDateApi(returnDate);

    try {
      await loanBook(bookId, formattedToday, formattedReturnDate);
      setLoanStatus({
        isProcessing: true,
        feedback: "Boa leitura! Livro emprestado com sucesso!",
      });
    } catch (error) {
      setLoanStatus({
        isProcessing: true,
        feedback: "Desculpe, o livre pode já ter sido emprestrado.",
      });
    }
    setTimeout(
      () =>
        setLoanStatus({ isProcessing: false, feedback: "Por favor, aguarde" }),
      1500
    );
  };

  return (
    <Card variant="outlined">
      <CardMedia
        sx={{ height: 264 }}
        image={coverUrl ? coverUrl : "/cover.png"}
        title={title}
      />
      <CardContent>
        <Tooltip title={title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {title}
          </Typography>
        </Tooltip>
        <Typography variant="body2" color="text.secondary">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non
          arcu...
        </Typography>
        {loanStatus.isProcessing && (
          <Typography variant="body2">{loanStatus.feedback}</Typography>
        )}
      </CardContent>
      <CardActions>
        <Button
          size="small"
          variant="contained"
          fullWidth
          onClick={() => handleLoanBookAction(id)}
          disabled={loanStatus.isProcessing}
        >
          Emprestar
        </Button>
      </CardActions>
    </Card>
  );
};
