<?php

namespace BudgetTool\Infrastructure\Repository\File;

use BudgetTool\Model\Budget\Entity\Budget;
use BudgetTool\Model\Budget\Repository\BudgetRepository;

class XmlBudgetRepository implements BudgetRepository
{
    /**
     * @param Budget $budget
     * @return mixed
     */
    public function save(Budget $budget)
    {
        $writer = new \XMLWriter();
        $writer->openURI(getcwd() . '/var/budgets/xml/'.$budget->getBudgetId()->toString() .'.xml');
        $writer->setIndent(true);
        $writer->startDocument();
        $writer->startElement('budget');
        $writer->writeElement('id', $budget->getBudgetId()->toString());
        $writer->startElement('title');
        $writer->writeCData($budget->getTitle());
        $writer->endElement();
        $writer->writeElement('title', $budget->getTitle());
        $writer->writeElement('period', $budget->getPeriod()->toString());
        $writer->writeElement('user_id', $budget->getUserId()->toString());
        $writer->endElement();
        $writer->flush();
    }
}